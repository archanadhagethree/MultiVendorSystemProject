<?php

namespace App\Services;

use App\Models\CartItem;
use App\Models\User;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\Facades\DB;

class CartService {

    protected $productRepo;

    public function __construct(ProductRepositoryInterface $productRepo){ 
        $this->productRepo=$productRepo; 
    }
    
    public function add(User $user, $productId, $qty)
    {
        $product = $this->productRepo->find($productId);

        // Check if stock is sufficient
        if ($product->stock < $qty) {
            throw new \Exception("Stock insufficient");
        }
        $cart = $user->cart()->firstOrCreate();
        CartItem::updateOrCreate(
            [
                'cart_id'    => $cart->id,
                'product_id' => $productId
            ],
            [
                'quantity' => DB::raw("quantity + $qty")
            ]
        );
    }

}