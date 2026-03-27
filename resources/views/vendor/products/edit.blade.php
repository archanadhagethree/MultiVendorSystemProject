<x-app-layout>
    <div class="py-12 bg-gradient-to-br from-blue-50 via-sky-100 to-white min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-8 flex items-center justify-between px-4">
                <a href="{{ route('vendor.products.index') }}" class="group text-sky-600 hover:text-sky-800 font-bold flex items-center transition duration-300">
                    <div class="bg-white/50 p-2 rounded-lg mr-3 shadow-sm group-hover:bg-sky-500 group-hover:text-white transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    </div>
                    Back to Inventory
                </a>
                <h2 class="text-2xl font-extrabold text-sky-900 tracking-tight">Edit Product</h2>
            </div>

            <div class="backdrop-blur-xl bg-white/40 border border-white/30 rounded-3xl p-8 shadow-2xl">
                <form action="{{ route('vendor.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('PUT')

                    <div class="space-y-6">
                        <div>
                            <label class="block text-sky-800 font-bold mb-2 ml-1">Product Name</label>
                            <input type="text" name="name" value="{{ old('name', $product->name) }}" 
                                   class="w-full border-sky-200 focus:border-sky-500 focus:ring-sky-500 bg-white/60 rounded-xl transition-all duration-300 py-3 px-4 shadow-sm" 
                                   placeholder="Enter product name">
                            @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sky-800 font-bold mb-2 ml-1">Price (₹)</label>
                                <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" 
                                       class="w-full border-sky-200 focus:border-sky-500 focus:ring-sky-500 bg-white/60 rounded-xl transition-all duration-300 py-3 px-4 shadow-sm" >
                                @error('price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-sky-800 font-bold mb-2 ml-1">Stock Quantity</label>
                                <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" 
                                       class="w-full border-sky-200 focus:border-sky-500 focus:ring-sky-500 bg-white/60 rounded-xl transition-all duration-300 py-3 px-4 shadow-sm" >
                                @error('stock') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="bg-sky-50/50 p-6 rounded-2xl border border-sky-100 shadow-inner">
                            <label class="block text-sky-800 font-bold mb-4">Product Image</label>
                            <div class="flex flex-col md:flex-row items-center gap-6">
                                <div class="relative">
                                    <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://via.placeholder.com/150?text=No+Image' }}" 
                                         class="w-32 h-32 object-cover rounded-2xl border-4 border-white shadow-md" alt="Current image">
                                    <span class="absolute -bottom-2 -right-2 bg-sky-500 text-white text-[10px] px-2 py-1 rounded-md font-bold uppercase shadow-sm">Current</span>
                                </div>

                                <div class="flex-1 w-full">
                                    <p class="text-sm text-sky-700 mb-2 font-medium">Change image (Optional):</p>
                                    <input type="file" name="image" accept="image/*"
                                           class="w-full text-sm text-sky-600 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-sky-100 file:text-sky-700 hover:file:bg-sky-200 transition cursor-pointer">
                                    @error('image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row items-center gap-4 pt-4">
                            <button type="submit" 
                                    class="w-full sm:w-48 bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 text-black hover:text-white font-bold py-2.5 px-6 rounded-xl shadow-lg transition-all duration-300 transform hover:scale-105 active:scale-95">
                                UPDATE PRODUCT
                            </button>
                            
                            <a href="{{ route('vendor.products.index') }}" 
                               class="w-full sm:w-auto px-8 py-2.5 bg-white/60 hover:bg-white text-sky-700 font-bold rounded-xl border border-sky-200 transition duration-300 text-center">
                                Cancel
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>