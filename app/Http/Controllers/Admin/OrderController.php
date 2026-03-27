<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['user', 'vendor', 'items']);

        // 2. Filter by Customer Name or Email
        if ($request->filled('customer')) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->customer . '%')
                ->orWhere('email', 'like', '%' . $request->customer . '%');
            });
        }

        // 3. Filter by Vendor
        if ($request->filled('vendor_id')) {
            $query->where('vendor_id', $request->vendor_id);
        }

        // 4. Filter by Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->latest()->paginate(10);
        $vendors = \App\Models\Vendor::all(); 

        return view('admin.orders.index', compact('orders', 'vendors'));
    }

    public function show($id)
    {
        $order = Order::with(['items.product', 'vendor', 'payment', 'user'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }
}