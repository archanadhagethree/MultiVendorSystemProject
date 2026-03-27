<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Vendor Inventory Management') }}
            </h2>
            <a href="{{ route('vendor.products.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-bold hover:bg-blue-700">
                + Add New Product
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                    <p class="text-sm font-medium text-gray-500 uppercase">Total Items</p>
                    <p class="text-3xl font-bold text-gray-900">
                        {{ $products instanceof \Illuminate\Pagination\LengthAwarePaginator ? $products->total() : $products->count() }}
                    </p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                    <p class="text-sm font-medium text-gray-500 uppercase">Low Stock Alerts</p>
                    <p class="text-3xl font-bold text-red-600">{{ $products->where('stock', '<=', 5)->where('stock', '>', 0)->count() }}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                    <p class="text-sm font-medium text-gray-500 uppercase">Est. Inventory Value</p>
                    <p class="text-3xl font-bold text-green-600">₹{{ number_format($products->sum(fn($p) => $p->price * $p->stock), 2) }}</p>
                </div>
            </div>

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-50 border-l-4 border-green-400 text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="p-6">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 border-b text-gray-600 text-sm uppercase">
                                <th class="p-4 font-bold">Product info</th>
                                <th class="p-4 font-bold">Price</th>
                                <th class="p-4 font-bold">Stock Status</th>
                                <th class="p-4 font-bold">Last Updated</th>
                                <th class="p-4 font-bold text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($products as $product)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="p-4">
                                        <div class="font-bold text-gray-900">{{ $product->name }}</div>
                                        @if($product->image)
                                        <div class="w-20 h-20 rounded-lg overflow-hidden flex-shrink-0 bg-gray-100 border border-gray-200">
                                            <img 
                                                src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/150' }}"
                                                class="w-full h-full object-contain"
                                            >
                                        </div>
                                        @endif
                                    </td>
                                   
                                                                    <td class="p-4 text-gray-700 font-semibold">
                                        ₹{{ number_format($product->price, 2) }}
                                    </td>
                                    <td class="p-4">
                                        @if($product->stock <= 0)
                                            <span class="px-2 py-1 text-xs font-bold rounded bg-red-100 text-red-800 uppercase">Out of Stock</span>
                                        @elseif($product->stock <= 5)
                                            <span class="px-2 py-1 text-xs font-bold rounded bg-yellow-100 text-yellow-800 uppercase">Low Stock ({{ $product->stock }})</span>
                                        @else
                                            <span class="px-2 py-1 text-xs font-bold rounded bg-green-100 text-green-800 uppercase">In Stock ({{ $product->stock }})</span>
                                        @endif
                                    </td>
                                    <td class="p-4 text-sm text-gray-500">
                                        {{ $product->updated_at->diffForHumans() }}
                                    </td>
                                    <td class="p-4 text-right">
                                        <div class="flex justify-end items-center space-x-4">
                                            <a href="{{ route('vendor.products.edit', $product->id) }}" class="text-blue-600 hover:text-blue-900 font-bold text-md">Edit</a>
                                            <form action="{{ route('vendor.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 font-bold text-md">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="p-12 text-center text-gray-400">No products found.</td></tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-6 p-4 rounded">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>