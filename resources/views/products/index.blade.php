<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Shop Inventory') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-bold">Product List</h3>
                        <button class="bg-blue-600 text-white px-4 py-2 rounded text-sm">
                            + Add New Product
                        </button>
                    </div>
                    @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 border-b">
                                <th class="p-3">Product Name</th>
                                <th class="p-3">Price</th>
                                <th class="p-3">Stock Level</th>
                                <th class="p-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="p-3 font-medium">{{ $product->name }}</td>
                                    <td class="p-3">₹{{ number_format($product->price, 2) }}</td>
                                    <td class="p-3">
                                        @if($product->stock <= 5)
                                            <span class="text-red-600 font-bold">{{ $product->stock }} (Low)</span>
                                        @else
                                            <span class="text-green-600">{{ $product->stock }}</span>
                                        @endif
                                    </td>
                                    <td class="p-3">
                                        <a href="#" class="text-blue-500 hover:underline mr-3">Edit</a>
                                        <button class="text-red-500 hover:underline">Delete</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="p-6 text-center text-gray-500">
                                        You haven't added any products yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>