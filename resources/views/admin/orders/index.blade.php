<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
                <form method="GET" action="{{ route('admin.orders.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Search Customer</label>
                        <input type="text" name="customer" value="{{ request('customer') }}" placeholder="Name or Email..." 
                               class="w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Vendor</label>
                        <select name="vendor_id" class="w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">All Vendors</option>
                            @foreach($vendors as $vendor)
                                <option value="{{ $vendor->id }}" {{ request('vendor_id') == $vendor->id ? 'selected' : '' }}>
                                    {{ $vendor->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Status</label>
                        <select name="status" class="w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">All Statuses</option>
                            <option value="placed" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>

                    <div class="flex gap-2">
                        <button type="submit" class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-md">
                            Filter
                        </button>
                        <a href="{{ route('admin.orders.index') }}" class="flex-1 bg-gray-100 text-center py-2 px-4 rounded-md text-gray-600">
                            Reset
                        </a>
                    </div>
                </form>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="p-4 text-xs font-bold text-gray-500 uppercase">Order ID</th>
                            <th class="p-4 text-xs font-bold text-gray-500 uppercase">Customer</th>
                            <th class="p-4 text-xs font-bold text-gray-500 uppercase">Vendor</th>
                            <th class="p-4 text-xs font-bold text-gray-500 uppercase">Total</th>
                            <th class="p-4 text-xs font-bold text-gray-500 uppercase">Status</th>
                            <th class="p-4 text-right text-xs font-bold text-gray-500 uppercase">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($orders as $order)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="p-4 font-mono font-bold text-indigo-600">#{{ $order->id }}</td>
                                <td class="p-4">
                                    <div class="font-bold text-gray-900">{{ $order->user->name ?? 'Guest' }}</div>
                                    <div class="text-xs text-gray-500">{{ $order->user->email ?? '' }}</div>
                                </td>
                                <td class="p-4 text-gray-700 font-medium">{{ $order->vendor->name ?? 'N/A' }}</td>
                                <td class="p-4 font-black text-gray-900">₹{{ number_format($order->total, 2) }}</td>
                                <td class="p-4">
                                    <span class="px-2.5 py-1 rounded-full text-xs font-bold uppercase border {{ $order->status == 'paid' ? 'bg-green-100 text-green-800 border-green-200' : 'bg-blue-100 text-blue-800 border-blue-200' }}">
                                        {{ $order->status }}
                                    </span>
                                </td>
                                <td class="p-4 text-right">
                                    <a href="{{ route('admin.orders.show', $order->id) }}" class="text-indigo-600 hover:text-indigo-900 font-bold">
                                        View Details &rarr;
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-10 text-center text-gray-400 font-medium">No orders found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="p-4 border-t bg-gray-50">
                    {{ $orders->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>