<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddToCartRequest;
use App\Models\CartItem;
use Illuminate\Http\Request;
use App\Services\CartService;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {   
        $cart = auth()->user()
            ->cart()
            ->with('items.product.vendor')
            ->first();

        if (!$cart) {
            return view('cart.index', ['cart' => null]);
        }

        return view('cart.index', compact('cart'));
    }

    public function add(AddToCartRequest $request) 
    {
        $this->cartService->add(
            auth()->user(),
            $request->validated('product_id'),
            $request->validated('quantity') ?? 1
        );

        return response()->json([
            'message' => 'Item added to cart successfully!'
        ]);
    }

    public function remove($id)
    {
        $cartItem = \App\Models\CartItem::with('cart')->findOrFail($id);

        if (!$cartItem->cart || $cartItem->cart->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.'); 
        }

        $cartItem->delete();

        return back()->with('success', 'Item removed successfully!');
    }
}