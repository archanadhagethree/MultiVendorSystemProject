<?php

namespace App\Services;

use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use Illuminate\Support\Facades\DB;
use App\Events\OrderPlaced;

class CheckoutService
{
    protected $productRepo;
    protected $orderRepo;

    public function __construct(
        ProductRepositoryInterface $productRepo,
        OrderRepositoryInterface $orderRepo
    ) {
        $this->productRepo = $productRepo;
        $this->orderRepo = $orderRepo;
    }

    public function checkout($cart)
    {
        return DB::transaction(function () use ($cart) {

            $grouped = $cart->items->groupBy(fn($item) => $item->product->vendor_id);

            foreach ($grouped as $vendorId => $items) {

                $order = $this->orderRepo->create([
                    'user_id' => $cart->user_id,
                    'vendor_id' => $vendorId,
                    'total' => 0
                ]);

                $total = 0;

                foreach ($items as $item) {

                    $product = $this->productRepo->find($item->product_id);
                    $this->productRepo->decrementStock($product->id, $item->quantity);

                    $this->orderRepo->addItem($order->id, [
                        'product_id' => $product->id,
                        'price' => $product->price,
                        'quantity' => $item->quantity,
                        'status' => 'pending'
                    ]);

                    $order->update(['status' => 'processing']);

                    $total += $product->price * $item->quantity;
                }

                $this->orderRepo->updateTotal($order->id, $total);
                $order->update(['status' => 'paid']);

                $this->orderRepo->createPayment([
                    'order_id' => $order->id,
                    'status' => 'paid'
                ]);

                $order->refresh(); 
                $order->load('vendor');

                event(new OrderPlaced($order));
            }

            $cart->items()->delete();

            return true;
        });
    }
}