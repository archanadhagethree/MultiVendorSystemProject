<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $vendor = Auth::user()->vendor;
        $products = Product::where('vendor_id', $vendor->id)
        ->latest()
        ->paginate(10);

        return view('vendor.products.index', compact('products'));
    }

    public function create()
    {
        return view('vendor.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $vendor = Auth::user()->vendor;

        \App\Models\Product::create([
            'vendor_id' => $vendor->id,
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $imagePath,
        ]);

        return redirect()->route('vendor.products.index')->with('success', 'Product added successfully!');
    }

    public function edit(Product $product)
    {
        if ($product->vendor_id !== Auth::user()->vendor->id) {
            abort(403);
        }

        return view('vendor.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        if ($product->vendor_id !== Auth::user()->vendor->id) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image) { 
                Storage::disk('public')->delete($product->image); 
            }
            $product->image = $request->file('image')->store('products', 'public');
        }

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $product->image,
        ]);

        return redirect()->route('vendor.products.index')->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        if ($product->vendor_id !== Auth::user()->vendor->id) {
            abort(403);
        }
        if ($product->image) { 
            Storage::disk('public')->delete($product->image); 
        }

        $product->delete();

        return redirect()->route('vendor.products.index')->with('success', 'Product deleted!');
    }
}