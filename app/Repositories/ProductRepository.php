<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface {
    
    public function find($id){
        return Product::findOrFail($id); 
    }
    
    public function decrementStock($id, $qty)
    {
        // Lock the product row for update to prevent race conditions
        $product = Product::lockForUpdate()->findOrFail($id);
        // Check if stock is sufficient
        if ($product->stock < $qty) {
            throw new \Exception("Stock insufficient");
        }
        // Decrement the stock
        $product->decrement('stock', $qty);
        return $product;
    }
    public function incrementStock($id, $quantity)
    {
        return Product::where('id', $id)->increment('stock', $quantity);
    }
}
