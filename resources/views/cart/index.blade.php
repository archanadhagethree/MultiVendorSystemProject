<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight">
            {{ __('Your Shopping Cart') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(!$cart || $cart->items->isEmpty())
                <div class="bg-white rounded-2xl p-12 text-center shadow-sm border border-gray-100">
                    <div class="inline-flex p-4 rounded-full bg-indigo-50 text-indigo-600 mb-4">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Your cart is empty</h3>
                    <p class="text-gray-500 mb-6">Looks like you haven't added anything to your cart yet.</p>
                    <a href="{{ route('user.home') }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-700 transition">
                        Start Shopping
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    
                    <div class="lg:col-span-2 space-y-6">
                        @foreach($cart->items->groupBy(fn($i) => $i->product->vendor->name) as $vendor => $items)
                            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                                <div class="bg-gray-50/50 px-6 py-3 border-b border-gray-100 flex items-center justify-between">
                                    <span class="text-xs font-black text-indigo-600 uppercase tracking-widest">Store: {{ $vendor }}</span>
                                    <span class="text-xs text-gray-400 font-bold">{{ $items->count() }} item(s)</span>
                                </div>

                                <div class="divide-y divide-gray-100">
                                    @foreach($items as $item)
                                        <div class="p-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 hover:bg-gray-50/50 transition">
                                            @if($item->product->image)
                                                    <div class="w-20 h-20 rounded-xl overflow-hidden flex-shrink-0 bg-gray-100 border border-gray-100">
                                                        <img src="{{ asset('storage/' . $item->product->image) }}" 
                                                             alt="{{ $item->product->name }}" 
                                                             class="w-full h-full object-cover">
                                                    </div>
                                            @endif
                                            <div class="flex-1">
                                                <h4 class="font-bold text-gray-900 text-lg leading-tight">{{ $item->product->name }}</h4>
                                                <p class="text-sm text-gray-500 mt-1">Unit Price: ₹{{ number_format($item->product->price, 2) }}</p>
                                            </div>
                                            
                                            <div class="flex items-center justify-between w-full sm:w-auto gap-8">
                                                <div class="text-right min-w-[120px]">
                                                    <p class="text-xs font-bold text-gray-400 uppercase">Subtotal</p>
                                                    <p class="font-black text-gray-900 text-lg">
                                                        {{ $item->quantity }} × ₹{{ number_format($item->product->price, 2) }}
                                                    </p>
                                                </div>
                                                
                                                <form action="{{ route('user.cart.remove', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="p-2 text-gray-300 hover:text-red-500 transition tooltip" title="Remove Item">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8 sticky top-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-6 border-b border-gray-50 pb-4">Order Summary</h3>
                            
                            <div class="space-y-4 mb-8">
                                <div class="flex justify-between text-gray-600">
                                    <span class="font-medium">Items Subtotal</span>
                                    <span class="font-bold text-gray-900">₹{{ number_format($cart->items->sum(fn($i) => $i->quantity * $i->product->price), 2) }}</span>
                                </div>
                                <div class="flex justify-between text-gray-600">
                                    <span class="font-medium">Platform Fee</span>
                                    <span class="text-green-600 font-bold text-xs uppercase bg-green-50 px-2 py-0.5 rounded">Free</span>
                                </div>
                                
                                <div class="border-t border-gray-100 pt-5 flex justify-between items-end">
                                    <span class="font-bold text-gray-900 text-lg">Grand Total</span>
                                    <div class="text-right">
                                        <span class="block text-[10px] text-gray-400 font-black uppercase tracking-tighter">Amount to Pay</span>
                                        <span class="font-black text-3xl text-indigo-600">₹{{ number_format($cart->items->sum(fn($i) => $i->quantity * $i->product->price), 2) }}</span>
                                    </div>
                                </div>
                            </div>

                            <form method="POST" action="{{ route('user.checkout') }}">
                                @csrf
                                <button type="submit" class="w-full bg-indigo-600 text-white font-black py-4 rounded-xl hover:bg-indigo-700 transition shadow-lg shadow-indigo-100 flex items-center justify-center gap-3 active:scale-95 group">
                                    <span>Proceed to Checkout</span>
                                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                    </svg>
                                </button>
                            </form>
                            
                            <div class="mt-6 flex items-center justify-center gap-2 text-gray-400">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg>
                                <span class="text-xs font-bold uppercase tracking-widest">SSL Secure Payment</span>
                            </div>
                        </div>
                    </div>

                </div>
            @endif
        </div>
    </div>
</x-app-layout>