<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black leading-tight text-center">
            {{ __('ORDER DETAILS') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-md rounded-lg">
                <div class="p-6">
                    <form action="{{ route('buyer.orders.details.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Name -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                <input type="text" name="name" id="name" 
                                    class="mt-2 block w-full border-gray-300 rounded-md shadow-sm focus:ring-black focus:border-black" 
                                    value="{{ Auth::user()->name }}" required>
                            </div>

                            <!-- Address -->
                            <div>
                                <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                                <input type="text" name="address" id="address" 
                                    class="mt-2 block w-full border-gray-300 rounded-md shadow-sm focus:ring-black focus:border-black" 
                                    value="{{ Auth::user()->address }}" required>
                            </div>

                            <!-- Phone -->
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                                <input type="text" name="phone" id="phone" 
                                    class="mt-2 block w-full border-gray-300 rounded-md shadow-sm focus:ring-black focus:border-black" 
                                    value="{{ Auth::user()->phone_number }}" required>
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="email" id="email" 
                                    class="mt-2 block w-full border-gray-300 rounded-md shadow-sm focus:ring-black focus:border-black" 
                                    value="{{ Auth::user()->email }}" required>
                            </div>

                            <!-- Type -->
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                                <select name="type" id="type" 
                                    class="mt-2 block w-full border-gray-300 rounded-md shadow-sm focus:ring-black focus:border-black" required>
                                    <option value="a">Fast</option>
                                    <option value="b">Low</option>
                                </select>
                            </div>

                            <!-- Buy Method -->
                            <div>
                                <label for="buy_method" class="block text-sm font-medium text-gray-700">Buy Method</label>
                                <select name="buy_method" id="buy_method" 
                                    class="mt-2 block w-full border-gray-300 rounded-md shadow-sm focus:ring-black focus:border-black" required>
                                    <option value="a">Gopay</option>
                                    <option value="b">Ovo</option>
                                    <option value="c">ShopeePay</option>
                                </select>
                            </div>
                        </div>

                        <!-- Products -->
                        <div class="mt-6">
                            <h3 class="text-lg font-semibold text-gray-700">Products:</h3>
                            <ul class="mt-2 text-gray-600">
                                @php
                                    $totalAmount = 0;
                                @endphp
                                @foreach($cartItems as $item)
                                    @php
                                        $totalAmount += $item->product->price * $item->amount;
                                    @endphp
                                    <li>{{ $item->product->name }} - ${{ number_format($item->product->price, 2) }} x {{ $item->amount }}</li>
                                    <input type="hidden" name="cart_items[]" value="{{ $item->id }}">
                                    <input type="hidden" name="product_ids[]" value="{{ $item->product->id }}">
                                    <input type="hidden" name="amounts[]" value="{{ $item->amount }}">
                                    <input type="hidden" name="prices[]" value="{{ $item->product->price }}">
                                @endforeach
                            </ul>
                            <p class="mt-4 text-xl font-semibold text-gray-700">Total Amount: ${{ number_format($totalAmount, 2) }}</p>
                            <input type="hidden" name="total_amount" value="{{ $totalAmount }}">
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-6">
                            <button type="submit" 
                                class="w-full bg-black hover:bg-black text-white font-semibold py-3 px-4 rounded-md shadow">
                                Buy Now
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
