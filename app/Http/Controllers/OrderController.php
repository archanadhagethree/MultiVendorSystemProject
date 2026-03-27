<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; 
use Illuminate\Support\Facades\Gate; 

class OrderController extends Controller
{
    public function index()
    {
        $query = Order::with(['items.product', 'vendor']);

        if (auth()->user()->role !== 'admin') {
            $query->where('user_id', auth()->id());
        }
        
        $orders = $query->latest()->paginate(10);
    
        return view('orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with(['items.product', 'vendor'])->findOrFail($id);
        Gate::authorize('view', $order);
        return view('orders.show', compact('order'));
    }
}