<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vendor Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">Welcome, {{ auth()->user()->vendor->name }}!</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <div class="border p-4 rounded bg-green-50">
                            <h4 class="font-bold">Order Management</h4>
                            <p class="text-sm text-gray-600 mb-3">View and manage orders specifically for your products.</p>
                            <a href="{{ route('vendor.orders.index') }}" class="text-green-700 font-bold underline">
                                View My Orders &rarr;
                            </a>
                        </div>

                        <div class="border p-4 rounded bg-blue-50">
                            <h4 class="font-bold">Product Catalog</h4>
                            <p class="text-sm text-gray-600 mb-3">Manage your stock and pricing.</p>
                            <a href="{{ route('vendor.products.index') }}" class="text-blue-700 font-bold underline">
                                Manage My Products &rarr;
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>