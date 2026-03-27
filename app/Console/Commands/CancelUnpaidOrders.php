<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CancelUnpaidOrders extends Command
{
    protected $signature = 'orders:cancel-unpaid';
    protected $description = 'Cancel orders that have been pending payment for more than 24 hours';

    public function handle(ProductRepositoryInterface $productRepo)
    {
        // Find orders that are 'pending' and older than 24 hours
        $orders = Order::where('status', 'pending')
            ->where('created_at', '<=', now()->subHours(24))
            ->get();

        foreach ($orders as $order) {
            DB::transaction(function () use ($order, $productRepo) {
                foreach ($order->items as $item) {
                    $productRepo->incrementStock($item->product_id, $item->quantity);
                }
                $order->update(['status' => 'cancelled']);
            });
        }
        
        $this->info('Pending orders older than 24h have been cancelled.');
    }
}