<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 light:text-gray-200 leading-tight">
            {{ __('Order Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white light:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white light:bg-gray-800 border-b border-gray-200 light:border-gray-700">
                    <div class="mb-4">
                        <h3 class="text-lg font-medium text-gray-900 light:text-gray-100">Order ID: {{ $order->id }}</h3>
                        <p class="text-sm text-gray-600 light:text-gray-400">Order Date: {{ $order->order_date }}</p>
                        <p class="text-sm text-gray-600 light:text-gray-400">Order Date: {{ $order->estimated_arrival }}</p>
                        <p class="text-sm text-gray-600 light:text-gray-400">Status: {{ $order->status }}</p>
                        <p class="text-sm text-gray-600 light:text-gray-400">Total Amount: ${{ number_format($order->total_amount, 2) }}</p>
                    </div>

                    <table class="min-w-full divide-y divide-gray-200 light:divide-gray-700">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 light:bg-gray-700 text-left text-xs font-medium text-gray-500 light:text-gray-300 uppercase tracking-wider">
                                    Product
                                </th>
                                <th class="px-6 py-3 bg-gray-50 light:bg-gray-700 text-left text-xs font-medium text-gray-500 light:text-gray-300 uppercase tracking-wider">
                                    Quantity
                                </th>
                                <th class="px-6 py-3 bg-gray-50 light:bg-gray-700 text-left text-xs font-medium text-gray-500 light:text-gray-300 uppercase tracking-wider">
                                    Price
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white light:bg-gray-800 divide-y divide-gray-200 light:divide-gray-700">
                            @foreach($order->orderDetails as $detail)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $detail->product->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $detail->quantity }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        ${{ number_format($detail->price, 2) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-8">
                        <h4 class="text-lg font-semibold text-gray-900 light:text-gray-100">Comments and Ratings:</h4>
                        <div class="mt-2 text-gray-700 light:text-gray-300">
                            @foreach($order->orderDetails as $detail)
                                @foreach($detail->product->comments as $comment)
                                    <div class="mb-4">
                                        <p><strong>{{ $comment->user->name }}</strong></p>
                                        <p>{{ $comment->comment }}</p>
                                        <p> {{ $comment->rating }} stars</p>
                                    </div>
                                @endforeach
                            @endforeach
                        </div>
                        @auth
                            <form action="{{ route('comments.store', $order->id) }}" method="POST" class="mt-4">
                                @csrf
                                <div>
                                    <label for="comment" class="block text-sm font-medium text-gray-700 light:text-gray-300">Comment</label>
                                    <textarea name="comment" id="comment" rows="4" class="mt-1 block w-full rounded-xl" required></textarea>
                                </div>
                                <div class="mt-4">
                                    <label for="rating" class="block text-sm font-medium text-gray-700 light:text-gray-300">Rating</label>
                                    <select name="rating" id="rating" class="mt-1 block w-full rounded-xl" required>
                                        <option value="1">1 star</option>
                                        <option value="2">2 stars</option>
                                        <option value="3">3 stars</option>
                                        <option value="4">4 stars</option>
                                        <option value="5">5 stars</option>
                                    </select>
                                </div>
                                <div class="mt-4">
                                    <button type="submit" class="bg-black hover:bg-white hover:text-black text-white font-semibold py-2 px-4 rounded-lg shadow">Submit</button>
                                </div>
                            </form>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>