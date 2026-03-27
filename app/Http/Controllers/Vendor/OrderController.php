<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $vendor = Auth::user()->vendor;

        if (!$vendor) {
            abort(403, 'You do not have a vendor profile.');
        }

        $orders = Order::with(['items.product', 'user'])
            ->where('vendor_id', $vendor->id)
            ->latest()
            ->paginate(10);
            
        return view('vendor.orders.index', compact('orders'));
    }
    
}