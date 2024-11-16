<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Product Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 md:flex">
                    <!-- Product Image -->
                    <div class="md:w-1/2">
                        <img 
                            src="{{ asset('storage/' . $product->image) }}" 
                            alt="{{ $product->name }}" 
                            class="w-full h-80 object-cover rounded-lg shadow-md"
                            onerror="this.onerror=null;this.src='/path/to/default-image.png';"
                        >
                    </div>

                    <!-- Product Details -->
                    <div class="md:w-1/2 md:pl-6 mt-6 md:mt-0">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $product->name }}</h3>
                        <p class="mt-4 text-gray-700 dark:text-gray-300">
                            {{ $product->description }}
                        </p>
                        <p class="mt-4 text-2xl text-red-600 dark:text-red-400 font-semibold">
                            ${{ number_format($product->price, 2) }}
                        </p>

                        <!-- Action Buttons -->
                        <div class="mt-6 flex space-x-4">
                            <form action="{{ route('buyer.cart.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button 
                                    type="submit"
                                    class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow"
                                >
                                    Add to Cart
                                </button>
                            </form>
                            <form action="{{ route('buyer.favorites.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button 
                                    type="submit"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded-lg shadow"
                                >
                                    Add to Favorites
                                </button>
                            </form>
                            <button 
                                class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg shadow"
                            >
                                Buy Now
                            </button>
                        </div>

                        <!-- Product Description -->
                        <div class="mt-8">
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Description:</h4>
                            <div class="mt-2 text-gray-700 dark:text-gray-300">
                                {{ $product->description }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
