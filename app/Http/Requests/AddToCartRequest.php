<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddToCartRequest extends FormRequest
{
    public function authorize()
    {
        return true; 
    }

    public function rules()
    {
        return [
            'product_id' => 'required|exists:products,id',
            'quantity' => 'nullable|integer|min:1'
        ];
    }
    public function messages(): array
    {
        return [
            'product_id.required' => 'Product is required',
            'product_id.exists'   => 'Invalid product selected',
            'quantity.required'   => 'Quantity is required',
            'quantity.integer'    => 'Quantity must be a number',
            'quantity.min'        => 'Minimum quantity is 1',
        ];
    }
}
