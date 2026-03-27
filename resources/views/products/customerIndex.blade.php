<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                {{ __('Shop Our Products') }}
            </h2>
            
            <div class="flex items-center gap-4">
                <a href="{{ route('user.cart') }}" class="relative inline-flex items-center px-6 py-2.5 text-sm font-bold text-center text-white bg-indigo-600 rounded-xl hover:bg-indigo-700 transition shadow-md hover:shadow-lg active:scale-95">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    View My Cart
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @forelse($products as $product)
                    <div class="group bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-all duration-200 flex flex-col h-full">
                        
                        <div class="mb-6">
                            {{-- Image Condition Added Here --}}
                            @if($product->image)
                                <div class="mb-4 overflow-hidden rounded-xl aspect-square bg-gray-100">
                                    <img src="{{ asset('storage/' . $product->image) }}" 
                                         alt="{{ $product->name }}" 
                                         class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                                </div>
                            @else
                                {{-- Elegant Placeholder for missing images --}}
                                <div class="mb-4 rounded-xl aspect-square bg-indigo-50 flex flex-col items-center justify-center border border-indigo-100 group-hover:bg-indigo-100 transition-colors">
                                    <svg class="w-12 h-12 text-indigo-200 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <span class="text-[10px] font-bold text-indigo-300 uppercase tracking-widest">No Image Available</span>
                                </div>
                            @endif

                            <div class="flex justify-between items-start mb-3">
                                <span class="text-[10px] font-black text-indigo-500 uppercase tracking-widest bg-indigo-50 px-2 py-1 rounded">
                                    {{ $product->vendor->name ?? 'Official Store' }}
                                </span>
                                
                                @if($product->stock <= 5 && $product->stock > 0)
                                    <span class="text-[10px] font-bold text-orange-600 bg-orange-50 px-2 py-1 rounded uppercase">
                                        Low Stock: {{ $product->stock }}
                                    </span>
                                @endif
                            </div>
                            
                            <h3 class="text-lg font-bold text-gray-900 leading-tight mb-2 group-hover:text-indigo-600 transition-colors">
                                {{ $product->name }}
                            </h3>
                            
                            <div class="flex items-baseline gap-1">
                                <span class="text-3xl font-black text-gray-900">₹{{ number_format($product->price, 2) }}</span>
                            </div>
                        </div>

                        <div class="mt-auto pt-6 border-t border-gray-100">
                            @if($product->stock > 0)
                                <form action="{{ route('user.cart.add') }}" method="POST" class="space-y-4">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    
                                    <div class="flex items-center justify-between">
                                        <label class="text-xs font-bold text-gray-400 uppercase">Quantity</label>
                                        <select id="qty_{{ $product->id }}" name="quantity" class="w-20 py-1.5 text-sm rounded-lg border-gray-200 focus:ring-indigo-500 focus:border-indigo-500 transition cursor-pointer">
                                            @for($i = 1; $i <= min($product->stock, 10); $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>

                                    <button type="button" 
                                            onclick="addToCart({{ $product->id }})" 
                                            class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
                                        Add to Cart
                                    </button>
                                </form>
                            @else
                                <div class="w-full bg-gray-100 text-gray-400 font-bold py-3.5 rounded-xl text-center cursor-not-allowed text-sm uppercase tracking-wide">
                                    Temporarily Out of Stock
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-20 text-center">
                        <div class="inline-flex p-4 rounded-full bg-gray-100 mb-4">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">No Products Found</h3>
                        <p class="text-gray-500">Check back later for new arrivals.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-12 px-4 py-6 border-t border-gray-100">
                {{ $products->links() }}
            </div>

        </div>
    </div>
</x-app-layout>

<script>
    function addToCart(productId) {
        const quantity = document.getElementById('qty_' + productId).value;
        fetch("{{ route('user.cart.add') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                product_id: productId,
                quantity: quantity
            })
        })
        .then(response => {
            if (!response.ok) throw new Error('Network response was not ok');
            return response.json();
        })
        .then(data => {
            alert(data.message);
        })
        .catch(error => {
            console.error('Error:', error);
            alert("Could not add item to cart. Please try again.");
        });
    }
</script>