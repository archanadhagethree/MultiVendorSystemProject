<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sales Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                    <p class="text-sm font-medium text-gray-500 uppercase">Total Revenue</p>
                    <p class="text-3xl font-bold text-green-600">
                        ₹{{ number_format($orders->where('status', 'paid')->sum('total'), 2) }}
                    </p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                    <p class="text-sm font-medium text-gray-500 uppercase">Active Orders</p>
                    <p class="text-3xl font-bold text-orange-500">
                        {{ $orders->where('status', 'paid')->count() }}
                    </p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                    <p class="text-sm font-medium text-gray-500 uppercase">Completed Sales</p>
                    <p class="text-3xl font-bold text-blue-600">
                        {{ $orders->where('status', 'paid')->count() }}
                    </p>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-50 border-b text-gray-600 text-sm uppercase">
                                    <th class="p-4 font-bold">Order ID</th>
                                    <th class="p-4 font-bold">Customer</th>
                                    <th class="p-4 font-bold">Items Purchased</th>
                                    <th class="p-4 font-bold">Total Earned</th>
                                    <th class="p-4 font-bold">Status</th>
                                    <th class="p-4 font-bold">Date</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($orders as $order)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="p-4 font-mono text-sm text-blue-600 font-bold">
                                            #{{ $order->id }}
                                        </td>
                                        <td class="p-4">
                                            <div class="text-sm font-bold text-gray-900">{{ $order->user->name ?? 'Guest' }}</div>
                                            <div class="text-xs text-gray-500">{{ $order->user->email ?? '' }}</div>
                                        </td>
                                        <td class="p-4 text-sm text-gray-600">
                                            <ul class="list-disc list-inside">
                                                @foreach($order->items as $item)
                                                    <li>
                                                        {{ $item->product->name ?? 'Deleted Product' }} 
                                                        <span class="text-gray-400 font-medium">x{{ $item->quantity }}</span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td class="p-4 font-bold text-gray-900 text-lg">
                                            ₹{{ number_format($order->total, 2) }}
                                        </td>
                                        <td class="p-4">
                                            @php
                                                $statusClasses = [
                                                    'pending' => 'bg-orange-100 text-orange-800 border border-orange-200',
                                                    'paid' => 'bg-green-100 text-green-800 border border-green-200',
                                                    'cancelled' => 'bg-red-100 text-red-800 border border-red-200'
                                                    ];
                                                $class = $statusClasses[$order->status] ?? 'bg-gray-100 text-gray-800';
                                            @endphp
                                            <span class="px-3 py-1 rounded-full text-xs font-black uppercase tracking-wider {{ $class }}">
                                                {{ $order->status }}
                                            </span>
                                        </td>
                                        <td class="p-4 text-sm text-gray-500">
                                            <div class="font-medium text-gray-700">{{ $order->created_at->format('d M Y') }}</div>
                                            <div class="text-xs text-gray-400 italic">{{ $order->created_at->diffForHumans() }}</div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="p-12 text-center">
                                            <div class="flex flex-col items-center">
                                                <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                                </svg>
                                                <span class="text-gray-400 font-medium">No orders received yet for your store.</span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-8 flex justify-center">
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>