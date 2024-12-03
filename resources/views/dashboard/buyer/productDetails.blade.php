<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 light:text-gray-200 leading-tight">
            {{ __('Product Details') }}
        </h2>
    </x-slot> --}}

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white light:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
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
                        <div class="flex items-center space-x-4 mt-4 mb-5">
                            <img 
                              src="{{ asset('storage/' . $product->store->image) }}" 
                              alt="{{ $product->store->name }}" 
                              class="w-7 h-7 object-cover rounded-full shadow-md"
                              onerror="this.onerror=null;this.src='/path/to/default-store-image.png';"
                            >
                            <p class="text-gray-700 light:text-gray-300">
                              <a class="text-black">
                                {{ $product->store->name }}
                              </a>
                            </p>
                        </div>                          
                        <h3 class="text-2xl font-bold text-gray-900 light:text-gray-100">{{ $product->name }}</h3>
                        <p class="mt-4 text-gray-700 light:text-gray-300">
                            {{ $product->description }}
                        </p>
                        <p class="mt-4 text-2xl text-black light:text-red-400 font-semibold">
                            ${{ number_format($product->price, 2) }}
                        </p>
                        

                        <!-- Action Buttons -->
                        <div class="mt-6 flex space-x-4">
                            @auth
                                <!-- Buy Now Link -->
                                <a 
                                    href="{{ route('buyer.orders.buyNow', ['product' => $product->id]) }}"
                                    class="w-full bg-black hover:bg-grey-500 text-white font-semibold py-2 px-4 rounded-lg shadow text-center"
                                >
                                    Buy Now
                                </a>
                                <form action="{{ route('buyer.cart.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button 
                                        type="submit"
                                        class="bg-black hover:bg-grey-500 text-white font-semibold py-2 px-4 rounded-lg shadow"
                                    >
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFFFFF"><path d="M240-80q-33 0-56.5-23.5T160-160v-480q0-33 23.5-56.5T240-720h80q0-66 47-113t113-47q66 0 113 47t47 113h80q33 0 56.5 23.5T800-640v480q0 33-23.5 56.5T720-80H240Zm0-80h480v-480h-80v80q0 17-11.5 28.5T600-520q-17 0-28.5-11.5T560-560v-80H400v80q0 17-11.5 28.5T360-520q-17 0-28.5-11.5T320-560v-80h-80v480Zm160-560h160q0-33-23.5-56.5T480-800q-33 0-56.5 23.5T400-720ZM240-160v-480 480Z"/></svg>
                                    </button>
                                </form>
                                <form action="{{ route('buyer.favorites.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button 
                                        type="submit"
                                        class="bg-black hover:bg-greyy-500 text-white font-semibold py-2 px-4 rounded-lg shadow"
                                    >
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFFFFF"><path d="m480-120-58-52q-101-91-167-157T150-447.5Q111-500 95.5-544T80-634q0-94 63-157t157-63q52 0 99 22t81 62q34-40 81-62t99-22q94 0 157 63t63 157q0 46-15.5 90T810-447.5Q771-395 705-329T538-172l-58 52Zm0-108q96-86 158-147.5t98-107q36-45.5 50-81t14-70.5q0-60-40-100t-100-40q-47 0-87 26.5T518-680h-76q-15-41-55-67.5T300-774q-60 0-100 40t-40 100q0 35 14 70.5t50 81q36 45.5 98 107T480-228Zm0-273Z"/></svg>
                                    </button>
                                </form>
                            @else
                                <a 
                                    href="{{ route('login') }}"
                                    class="w-full bg-black hover:bg-grey-500 text-white font-semibold py-2 px-4 rounded-lg shadow text-center"
                                >
                                    Buy Now
                                </a>
                                <a 
                                    href="{{ route('login') }}"
                                    class="bg-black hover:bg-greyy-500 text-white font-semibold py-2 px-4 rounded-lg shadow"
                                >
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFFFFF"><path d="M240-80q-33 0-56.5-23.5T160-160v-480q0-33 23.5-56.5T240-720h80q0-66 47-113t113-47q66 0 113 47t47 113h80q33 0 56.5 23.5T800-640v480q0 33-23.5 56.5T720-80H240Zm0-80h480v-480h-80v80q0 17-11.5 28.5T600-520q-17 0-28.5-11.5T560-560v-80H400v80q0 17-11.5 28.5T360-520q-17 0-28.5-11.5T320-560v-80h-80v480Zm160-560h160q0-33-23.5-56.5T480-800q-33 0-56.5 23.5T400-720ZM240-160v-480 480Z"/></svg>
                                </a>
                                <a 
                                    href="{{ route('login') }}"
                                    class="bg-black hover:bg-greyy-500 text-white font-semibold py-2 px-4 rounded-lg shadow"
                                >
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFFFFF"><path d="m480-120-58-52q-101-91-167-157T150-447.5Q111-500 95.5-544T80-634q0-94 63-157t157-63q52 0 99 22t81 62q34-40 81-62t99-22q94 0 157 63t63 157q0 46-15.5 90T810-447.5Q771-395 705-329T538-172l-58 52Zm0-108q96-86 158-147.5t98-107q36-45.5 50-81t14-70.5q0-60-40-100t-100-40q-47 0-87 26.5T518-680h-76q-15-41-55-67.5T300-774q-60 0-100 40t-40 100q0 35 14 70.5t50 81q36 45.5 98 107T480-228Zm0-273Z"/></svg>
                            </a>
                            @endauth
                        </div>

                        <!-- Store Details Card -->
                        

                        <!-- Product Description -->
                        <div class="mt-8">
                            <h4 class="text-lg font-semibold text-gray-900 light:text-gray-100">Description</h4>
                            <div class="mt-2 text-gray-700 light:text-gray-300">
                                {{ $product->description }}
                            </div>
                        </div>

                        <!-- Comments and Ratings -->
                        <div class="mt-8">
                            <h4 class="text-lg font-semibold text-gray-900 light:text-gray-100">Comments and Ratings</h4>
                            <div class="mt-2 text-gray-700 light:text-gray-300">
                                @foreach($product->comments as $comment)
                                    <div class="mb-4">
                                        <p><strong>{{ $comment->user->name }}</strong></p>
                                        <p>Rating  : {{ $comment->rating }} stars</p>
                                        <p>Comment : {{ $comment->comment }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full mt-8 bg-white light:bg-gray-800 p-6 rounded-lg shadow-lg">
                <h4 class="text-lg font-semibold text-gray-900 light:text-gray-100">Store Details</h4>
                <div class="mt-4 flex items-center space-x-4">
                    <img 
                        src="{{ asset('storage/' . $product->store->image) }}" 
                        alt="{{ $product->store->name }}" 
                        class="w-16 h-16 object-cover rounded-full shadow-md"
                        onerror="this.onerror=null;this.src='/path/to/default-store-image.png';"
                    >
                    <div>
                        <h3 class="text-gray-700 light:text-gray-300">
                            <h3 class="text-black">
                                <b>{{ $product->store->name }}</b>
                            </h3>
                        </h3>
                        <p class="text-gray-500 light:text-gray-400">
                            {{ $product->store->description }}
                        </p>
                        <p class="text-gray-500 light:text-gray-400">
                            {{ $product->store->address }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
