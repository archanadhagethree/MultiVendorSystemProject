<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight">
            {{ __('My Order History') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            
            @forelse($orders as $order)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden mb-6 hover:shadow-md transition-shadow">
                    <div class="bg-gray-50/50 px-6 py-4 border-b border-gray-100 flex flex-wrap justify-between items-center gap-4">
                        <div class="flex items-center gap-6">
                            <div>
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Order Placed</p>
                                <p class="text-sm font-bold text-gray-700">{{ $order->created_at->format('d M, Y') }}</p>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Total Amount</p>
                                <p class="text-sm font-bold text-gray-900">₹{{ number_format($order->total, 2) }}</p>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Ship To</p>
                                <p class="text-sm font-bold text-indigo-600">{{ Auth::user()->name }}</p>
                            </div>
                        </div>

                        <div class="text-right">
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Order #ID</p>
                            <span class="text-xs font-mono font-bold bg-white border border-gray-200 px-2 py-1 rounded">
                                {{ $order->id }}
                            </span>
                        </div>
                    </div>

                    <div class="p-6">
                        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-2">
                                    @php
                                        $statusClasses = [
                                            'pending' => 'bg-orange-50 text-orange-600 border-orange-100',
                                            'completed' => 'bg-green-50 text-green-600 border-green-100',
                                            'cancelled' => 'bg-red-50 text-red-600 border-red-100',
                                        ];
                                        $currentStatus = strtolower($order->status ?? 'pending');
                                    @endphp
                                    <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider border {{ $statusClasses[$currentStatus] ?? 'bg-gray-50 text-gray-600 border-gray-100' }}">
                                        {{ $order->status ?? 'Pending' }}
                                    </span>
                                    <span class="text-gray-300">•</span>
                                    <span class="text-sm font-bold text-gray-500">
                                        Sold by: <span class="text-gray-900">{{ $order->vendor->name }}</span>
                                    </span>
                                </div>

                                <p class="text-gray-600 text-sm">
                                    {{ $order->items->count() }} item(s): 
                                    <span class="font-medium">
                                        {{ $order->items->take(2)->map(fn($item) => $item->product->name)->join(', ') }}
                                        @if($order->items->count() > 2) ...and more @endif
                                    </span>
                                </p>
                            </div>

                            <div class="flex items-center gap-3 w-full md:w-auto">
                                <a href="{{ route('users.orders.show', $order->id) }}" class="flex-1 md:flex-none text-center px-6 py-2.5 bg-white border border-gray-300 text-gray-700 font-bold text-sm rounded-xl hover:bg-gray-50 transition active:scale-95">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-2xl p-16 text-center shadow-sm border border-gray-100">
                    <div class="inline-flex p-4 rounded-full bg-gray-50 text-gray-400 mb-4">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">No orders yet</h3>
                    <p class="text-gray-500 mb-8">When you buy something, it will appear here.</p>
                    <a href="{{ route('user.home') }}" class="inline-flex items-center px-8 py-3 bg-indigo-600 text-white font-black rounded-xl hover:bg-indigo-700 transition">
                        Start Exploring
                    </a>
                </div>
            @endforelse

            <div class="mt-8 px-2">
                {{ $orders->links() }}
            </div>

        </div>
    </div>
</x-app-layout>