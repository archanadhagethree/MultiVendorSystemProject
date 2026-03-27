<x-app-layout>
    <div class="py-12 bg-white min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-6">
                <a href="{{ route('vendor.products.index') }}" class="text-sky-600 hover:text-sky-800 font-bold flex items-center transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Back to Products
                </a>
            </div>

            <div class="backdrop-blur-xl bg-white border border-gray-200 rounded-3xl p-8 shadow-2xl">
                <h2 class="text-3xl font-extrabold text-sky-900 mb-8 text-center tracking-tight">
                    Add New Product
                </h2>

                <form action="{{ route('vendor.products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-6">
                        <label class="block text-sky-800 font-bold mb-2 ml-1">Product Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" 
                               class="w-full border-sky-200 focus:border-sky-500 focus:ring-sky-500 bg-white rounded-xl transition-all duration-300 py-3" 
                               placeholder="e.g. Wireless Headphones">
                        @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sky-800 font-bold mb-2 ml-1">Price (₹)</label>
                            <input type="number" step="0.01" name="price" value="{{ old('price') }}" 
                                   class="w-full border-sky-200 focus:border-sky-500 focus:ring-sky-500 bg-white rounded-xl transition-all duration-300 py-3" 
                                   placeholder="0.00">
                            @error('price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sky-800 font-bold mb-2 ml-1">Stock Quantity</label>
                            <input type="number" name="stock" value="{{ old('stock') }}" 
                                   class="w-full border-sky-200 focus:border-sky-500 focus:ring-sky-500 bg-white rounded-xl transition-all duration-300 py-3" 
                                   placeholder="0">
                            @error('stock') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="mb-8">
                        <label class="block text-sky-800 font-bold mb-2 ml-1">Product Image</label>
                        <div class="flex items-center justify-center w-full">
                            <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-sky-200 border-dashed rounded-xl cursor-pointer bg-white hover:bg-sky-50 transition duration-300">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-8 h-8 mb-3 text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                    <p class="text-sm text-sky-600 font-medium">Click to upload product photo</p>
                                </div>
                                <input type="file" name="image" class="hidden" accept="image/*" />
                            </label>
                        </div>
                        @error('image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex justify-center w-full p-4">
                        <button type="submit" 
                                class="relative z-10 w-48 bg-sky-200 hover:bg-purple-600 text-black hover:text-white border-2 border-transparent hover:border-purple-800 font-extrabold py-4 px-6 rounded-2xl shadow-xl transition-all duration-300 transform hover:scale-[1.02] active:scale-95">
                            SAVE PRODUCT
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>