<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;

class OrderPolicy
{
    /**
     * Determine if the vendor can view the order.
     */
    public function view(User $user, Order $order)
    {
        if ($user->role === 'admin') return true;

        if ($user->role === 'vendor') {
            return $user->vendor && $user->vendor->id === $order->vendor_id;
        }

        return $user->id === $order->user_id;
    }
}