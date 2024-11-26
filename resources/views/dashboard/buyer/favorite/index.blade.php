<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 light:text-gray-200 leading-tight">
            {{ __('Favorite Products') }}
        </h2>
    </x-slot> --}}

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white light:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6">
                    @if($favorites->isEmpty())
                        <p class="text-gray-700 light:text-gray-300">You have no favorite products.</p>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($favorites as $favorite)
                                <div class="bg-white light:bg-gray-900 p-4 rounded-lg shadow-md">
                                    <img src="{{ asset('storage/' . $favorite->product->image) }}" alt="{{ $favorite->product->name }}" class="w-full h-48 object-cover rounded-lg">
                                    <h3 class="mt-4 text-lg font-bold text-gray-900 light:text-gray-100">{{ $favorite->product->name }}</h3>
                                    <p class="mt-2 text-gray-700 light:text-gray-300">{{ $favorite->product->description }}</p>
                                    <p class="mt-2 text-black light:text-red-400 font-semibold">${{ number_format($favorite->product->price, 2) }}</p>
                                    <div class="mt-4 flex space-x-4">
                                        <form action="{{ route('buyer.cart.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $favorite->product->id }}">
                                            <input type="hidden" name="amount" value="1"> <!-- Tetapkan nilai amount default -->
                                            <button 
                                                type="submit"
                                                class="bg-white hover:bg-black hover:text-white text-black font-semibold py-2 px-4 rounded-lg shadow"
                                            >
                                                Add to Cart
                                            </button>
                                        </form>
                                        <form action="{{ route('buyer.favorites.destroy', $favorite->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-black hover:bg-white hover:text-black text-white font-semibold py-2 px-4 rounded-lg shadow">Remove</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
