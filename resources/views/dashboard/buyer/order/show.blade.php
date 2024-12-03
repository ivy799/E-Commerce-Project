<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 light:text-gray-200 leading-tight">
            {{ __('Order Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white light:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="bg-gray-100 p-6 rounded-lg shadow-lg mb-6">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-black mb-2">
                        Order ID: {{ $order->id }}
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <p class="text-sm text-black dark:text-black">
                            <span class="font-semibold">Order Date:</span> {{ $order->order_date }}
                        </p>
                        <p class="text-sm text-gray-700 dark:text-black">
                            <span class="font-semibold">Estimated Arrival:</span> {{ $order->estimated_arrival }}
                        </p>
                        <p class="text-sm text-gray-700 dark:text-black">
                            <span class="font-semibold">Status:</span> 
                            <span class="inline-block px-2 py-1 rounded-full text-white text-xs {{ $order->status === 'Delivered' ? 'bg-green-500' : 'bg-yellow-500' }}">
                                {{ $order->status }}
                            </span>
                        </p>
                        <p class="text-sm text-gray-700 dark:text-black">
                            <span class="font-semibold">Total Amount:</span> ${{ number_format($order->total_amount, 2) }}
                        </p>
                    </div>
                </div>                

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($order->orderDetails as $detail)
                        <div class="bg-white light:bg-gray-900 shadow-lg rounded-xl p-6">
                            <h4 class="text-lg font-semibold text-gray-900 light:text-gray-100 mb-2">
                                {{ $detail->product->name }}
                            </h4>
                            <p class="text-sm text-gray-700 light:text-gray-400 mb-4">
                                Quantity: {{ $detail->quantity }}<br>
                                Price: ${{ number_format($detail->price, 2) }}
                            </p>

                            <div class="border-t border-black light:border-gray-700 mt-4 pt-4">
                                <h5 class="text-md font-medium text-gray-900 light:text-gray-100 mb-2">Comments & Ratings</h5>
                                <div class="space-y-4">
                                    @forelse($detail->product->comments as $comment)
                                        <div class="p-4 bg-gray-100 light:bg-gray-800 rounded-lg shadow-md">
                                            <p class="text-sm font-semibold text-gray-900 light:text-gray-100">{{ $comment->user->name }}</p>
                                            <p class="text-sm text-gray-700 light:text-gray-400">{{ $comment->comment }}</p>
                                            <div class="mt-2">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <span class="{{ $i <= $comment->rating ? 'text-yellow-400' : 'text-gray-400' }}">
                                                        &#9733;
                                                    </span>
                                                @endfor
                                            </div>
                                        </div>
                                    @empty
                                        <p class="text-sm text-gray-600 light:text-gray-400">No comments yet for this product.</p>
                                    @endforelse
                                </div>
                            </div>

                            @auth
                                <form action="{{ route('comments.store', $order->id) }}" method="POST" class="mt-6">
                                    @csrf
                                    <div class="mb-4">
                                        <label for="comment_{{ $detail->product_id }}" class="block text-sm font-medium text-gray-700 light:text-black">
                                            Add Comment for {{ $detail->product->name }}
                                        </label>
                                        <textarea name="comments[{{ $detail->product_id }}][comment]" id="comment_{{ $detail->product_id }}" rows="3" class="mt-1 block w-full border-black light:border-gray-600 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 light:bg-gray-800 light:text-gray-200" required></textarea>
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700 light:text-black">Rating</label>
                                        <div class="rating flex items-center gap-1" data-product-id="{{ $detail->product_id }}">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <label>
                                                    <input type="radio" name="comments[{{ $detail->product_id }}][rating]" value="{{ $i }}" class="hidden" required />
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20" class="star w-6 h-6 text-gray-400 hover:text-yellow-400 cursor-pointer transition duration-200">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.959a1 1 0 00.95.69h4.174c.969 0 1.371 1.24.588 1.81l-3.374 2.457a1 1 0 00-.364 1.118l1.286 3.959c.3.921-.755 1.688-1.54 1.118l-3.374-2.457a1 1 0 00-1.176 0l-3.374 2.457c-.784.57-1.84-.197-1.54-1.118l1.286-3.959a1 1 0 00-.364-1.118L2.29 9.386c-.783-.57-.38-1.81.588-1.81h4.174a1 1 0 00.95-.69l1.286-3.959z" />
                                                    </svg>
                                                </label>
                                            @endfor
                                        </div>
                                    </div>
                                    <button type="submit" class="mt-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg shadow">
                                        Submit
                                    </button>
                                </form>
                            @endauth
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


<script>
    document.querySelectorAll('.rating').forEach(ratingContainer => {
        const stars = ratingContainer.querySelectorAll('.star');
        let selectedRating = 0;

        stars.forEach((star, index) => {
            star.addEventListener('mouseover', () => {
                // Highlight all stars up to the hovered star
                updateStarColors(stars, index + 1);
            });

            star.addEventListener('mouseout', () => {
                // Revert to selected rating when not hovering
                updateStarColors(stars, selectedRating);
            });

            star.addEventListener('click', () => {
                // Set selected rating
                selectedRating = index + 1;
                updateStarColors(stars, selectedRating);
            });
        });

        const updateStarColors = (stars, rating) => {
            stars.forEach((star, index) => {
                if (index < rating) {
                    star.classList.add('text-yellow-400');
                    star.classList.remove('text-gray-400');
                } else {
                    star.classList.add('text-gray-400');
                    star.classList.remove('text-yellow-400');
                }
            });
        };
    });
</script>