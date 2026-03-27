<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('vendor')->paginate(10);

        return view('products.customerIndex', compact('products'));
    }
}