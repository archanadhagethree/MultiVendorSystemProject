<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow rounded-lg">
                <h2 class="text-2xl font-bold mb-4">Vendor Orders</h2>
                
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-100 text-left">
                            <th class="p-3">Order ID</th>
                            <th class="p-3">Total Amount</th>
                            <th class="p-3">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr class="border-b">
                            <td class="p-3">#{{ $order->id }}</td>
                            <td class="p-3">₹{{ number_format($order->total, 2) }}</td>
                            <td class="p-3 font-semibold">{{ ucfirst($order->status) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>