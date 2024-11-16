<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Order Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('buyer.orders.details.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                                <input type="text" name="name" id="name" class="mt-1 block w-full" required>
                            </div>
                            <div>
                                <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Address</label>
                                <input type="text" name="address" id="address" class="mt-1 block w-full" required>
                            </div>
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Phone</label>
                                <input type="text" name="phone" id="phone" class="mt-1 block w-full" required>
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                                <input type="email" name="email" id="email" class="mt-1 block w-full" required>
                            </div>
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Type</label>
                                <select name="type" id="type" class="mt-1 block w-full" required>
                                    <option value="a">A</option>
                                    <option value="b">B</option>
                                    <option value="c">C</option>
                                </select>
                            </div>
                            <div>
                                <label for="buy_method" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Buy Method</label>
                                <select name="buy_method" id="buy_method" class="mt-1 block w-full" required>
                                    <option value="a">A</option>
                                    <option value="b">B</option>
                                    <option value="c">C</option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Products:</h3>
                            <ul class="mt-2 text-gray-700 dark:text-gray-300">
                                @php
                                    $totalAmount = 0;
                                @endphp
                                @foreach($cartItems as $item)
                                    @php
                                        $totalAmount += $item->product->price * $item->amount;
                                    @endphp
                                    <li>{{ $item->product->name }} - ${{ number_format($item->product->price, 2) }} x {{ $item->amount }}</li>
                                    <input type="hidden" name="cart_items[]" value="{{ $item->id }}">
                                @endforeach
                            </ul>
                            <p class="mt-4 text-2xl text-red-600 dark:text-red-400 font-semibold">Total Amount: ${{ number_format($totalAmount, 2) }}</p>
                            <input type="hidden" name="total_amount" value="{{ $totalAmount }}">
                        </div>
                        <div class="mt-6">
                            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg shadow">Buy Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>