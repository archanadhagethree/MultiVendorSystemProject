<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                Order Details #{{ $order->id }}
            </h2>
            <a href="{{ route('users.orders.index') }}" class="text-sm font-bold text-indigo-600 hover:text-indigo-800">
                &larr; Back to Orders
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="p-8">
                    <h3 class="text-lg font-black uppercase tracking-widest text-gray-400 mb-6">Items Purchased</h3>
                    <div class="space-y-4">
                        @foreach($order->items as $item)
                            <div class="flex justify-between items-center py-4 border-b border-gray-50 last:border-0">
                                @if($item->product->image)
                                <div class="w-16 h-16 rounded-xl overflow-hidden flex-shrink-0 bg-gray-50 border border-gray-100">
                                    <img src="{{ asset('storage/' . $item->product->image) }}" 
                                         alt="{{ $item->product->name }}" 
                                         class="w-full h-full object-cover">
                                </div>
                            @endif
                                <div>
                                    <p class="font-bold text-gray-900">{{ $item->product->name }}</p>
                                    <p class="text-sm text-gray-500">Qty: {{ $item->quantity }}</p>
                                </div>
                                <p class="font-black text-gray-900">₹{{ number_format($item->price * $item->quantity, 2) }}</p>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-8 pt-6 border-t-2 border-dashed border-gray-100 flex justify-between items-center">
                        <span class="text-xl font-bold text-gray-900">Grand Total</span>
                        <span class="text-3xl font-black text-indigo-600">₹{{ number_format($order->total, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>