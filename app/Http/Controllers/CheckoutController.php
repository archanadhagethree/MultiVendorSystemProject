<?php

namespace App\Http\Controllers;

use App\Services\CheckoutService;

class CheckoutController extends Controller
{
    protected $checkoutService;

    public function __construct(CheckoutService $checkoutService)
    {
        $this->checkoutService = $checkoutService;
    }

    public function checkout()
    {
        $cart = auth()->user()
            ->cart()
            ->with('items.product')
            ->first();

        $this->checkoutService->checkout($cart);
        
        return redirect()->route('users.orders.index')
        ->with('success', 'Order placed successfully!');
    }
}