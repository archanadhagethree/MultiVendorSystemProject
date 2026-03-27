<?php

namespace App\Listeners;

use App\Events\OrderPlaced;
use App\Mail\OrderPlacedMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class LogOrderPlaced
{
    public function handle(OrderPlaced $event)
    {
        Log::info('Order placed ID: ' . $event->order->id);
        
        $order = $event->order;
        if (!$order->relationLoaded('user')) {
            $order->load('user');
        }

        if ($order->user) {
            Mail::to($order->user->email)->send(new OrderPlacedMail($order));
        }
    }
}