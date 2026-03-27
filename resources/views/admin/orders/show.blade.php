<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Order Details') }} #{{ $order->id }}
            </h2>
            <a href="{{ route('admin.orders.index') }}" class="text-sm font-bold text-indigo-600 hover:underline">
                &larr; Back to List
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8 border border-gray-200">
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10 pb-8 border-b border-gray-100">
                    <div>
                        <h3 class="text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Customer</h3>
                        <p class="text-lg font-bold text-gray-900">{{ $order->user->name }}</p>
                        <p class="text-gray-600">{{ $order->user->email }}</p>
                    </div>
                    <div>
                        <h3 class="text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Vendor Assigned</h3>
                        <p class="text-lg font-bold text-indigo-600">{{ $order->vendor->name }}</p>
                        <p class="text-gray-500 text-sm italic">Vendor ID: #{{ $order->vendor_id }}</p>
                    </div>
                    <div>
                        <h3 class="text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Order Summary</h3>
                        <span class="px-3 py-1 rounded-full text-xs font-bold uppercase bg-indigo-100 text-indigo-800">
                            {{ $order->status }}
                        </span>
                        <p class="mt-2 text-sm text-gray-500 font-medium">Date: {{ $order->created_at->format('M d, Y - h:i A') }}</p>
                    </div>
                </div>

                <h3 class="text-lg font-bold text-gray-800 mb-4">Items Purchased</h3>
                <div class="overflow-hidden border border-gray-100 rounded-lg mb-8">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50 text-gray-600 text-sm uppercase">
                            <tr>
                                <th class="p-4 w-20">Image</th> <th class="p-4">Product</th>
                                <th class="p-4 text-center">Unit Price</th>
                                <th class="p-4 text-center">Quantity</th>
                                <th class="p-4 text-right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($order->items as $item)
                                <tr>
                                    <td class="p-4">
                                        <div class="flex-shrink-0 w-16 h-16">
                                            <img class="w-full h-full object-cover rounded-lg border border-gray-200 shadow-sm" 
                                                 src="{{ $item->product && $item->product->image ? asset('storage/' . $item->product->image) : 'https://via.placeholder.com/150?text=No+Image' }}" 
                                                 alt="{{ $item->product->name ?? 'Product' }}">
                                        </div>
                                    </td>
                                    <td class="p-4">
                                        <div class="font-bold text-gray-900">{{ $item->product->name ?? 'Deleted Item' }}</div>
                                        <div class="text-xs text-gray-400">SKU: {{ $item->product_id }}</div>
                                    </td>
                                    <td class="p-4 text-center text-gray-600">₹{{ number_format($item->price, 2) }}</td>
                                    <td class="p-4 text-center font-bold text-gray-900">{{ $item->quantity }}</td>
                                    <td class="p-4 text-right font-bold text-gray-900">₹{{ number_format($item->price * $item->quantity, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-gray-50 border-t-2 border-indigo-100">
                            <tr>
                                <td colspan="4" class="p-4 text-right font-black text-gray-600 uppercase">Grand Total</td>
                                <td class="p-4 text-right font-black text-2xl text-indigo-600">₹{{ number_format($order->total, 2) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="bg-indigo-50 p-6 rounded-xl border border-indigo-100 flex justify-between items-center">
                    <div>
                        <h4 class="text-xs font-black text-indigo-400 uppercase mb-1">Payment Information</h4>
                        <p class="text-sm text-indigo-900 font-medium">
                            @if($order->status === 'paid')
                                This order was successfully processed and paid.
                            @else
                                Awaiting payment confirmation for this transaction.
                            @endif
                        </p>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-indigo-400 uppercase font-black">Order Reference</p>
                        <p class="text-sm font-mono font-bold text-indigo-700">ORD-{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>