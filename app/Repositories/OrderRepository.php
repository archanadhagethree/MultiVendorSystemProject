<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Repositories\Interfaces\OrderRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface
{
    public function create(array $data)
    {
        return Order::create($data);
    }

    public function addItem($orderId, array $data)
    {
        return OrderItem::create([
            'order_id' => $orderId,
            ...$data
        ]);
    }

    public function updateTotal($orderId, $total)
    {
        $order = Order::findOrFail($orderId);
        $order->update(['total' => $total]);

        return $order;
    }

    public function createPayment(array $data)
    {
        return Payment::create($data);
    }
}