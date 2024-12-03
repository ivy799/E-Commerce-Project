<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 light:text-gray-200 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="{{ route('seller.products.create') }}" class="px-4 py-2 bg-black text-white rounded-md shadow hover:bg-black">
                    Add Product
                </a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($products as $product)
                    <div class="bg-white light:bg-gray-800 shadow-md rounded-lg overflow-hidden">
                        <!-- Gambar Produk -->
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="h-48 w-full object-cover">

                        <!-- Detail Produk -->
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-800 light:text-gray-200 truncate">{{ $product->name }}</h3>
                            <p class="text-gray-600 light:text-gray-400 text-sm mb-2 truncate">{{ $product->category }}</p>
                            <p class="text-gray-900 light:text-gray-100 font-bold mb-2">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            <p class="text-sm text-gray-500 light:text-gray-400">Stock: {{ $product->stock }}</p>

                            <!-- Aksi -->
                            <div class="mt-4 flex justify-end gap-x-1 items-center">
                                <a href="{{ route('seller.products.edit', $product->id) }}" class="px-4 py-2 text-sm bg-white text-black rounded-md hover:bg-black hover:text-white shadow-md">
                                    Edit
                                </a>
                                <form action="{{ route('seller.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-4 py-2 text-sm bg-black text-white rounded-md hover:bg-white hover:text-black shadow-md">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
