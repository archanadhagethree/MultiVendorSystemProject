<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">
                <h3 class="text-lg font-bold mb-4">System Overview</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="border p-4 rounded bg-blue-50">
                        <a href="{{ route('admin.orders.index') }}" class="text-blue-600 font-bold underline">
                            Manage All Orders
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>