<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 light:text-gray-200 leading-tight">
            {{ __('Edit Product') }}
        </h2>
    </x-slot> --}}

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white light:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 light:text-gray-100">
                    <form action="{{ route('seller.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="space-y-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Product Name</label>
                                <input type="text" name="name" id="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ $product->name }}" required>
                            </div>
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                                <textarea name="description" id="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" rows="4" required>{{ $product->description }}</textarea>
                            </div>
                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                                <input type="number" name="price" id="price" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ $product->price }}" required oninput="this.value = Math.abs(this.value)">
                            </div>
                            <div>
                                <label for="stock" class="block text-sm font-medium text-gray-700">Stock</label>
                                <input type="number" name="stock" id="stock" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ $product->stock }}" required oninput="this.value = Math.abs(this.value)">
                            </div>
                            <div>
                                <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                                <input type="text" name="category" id="category" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ $product->category }}" required>
                            </div>
                            <div>
                                <label for="image" class="block text-sm font-medium text-gray-700">Media</label>
                                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                            <path d="M28 8H20V16H8V28H16V40H28V32H40V20H32V8H28ZM12 20H4V12H12V20ZM40 12H32V4H40V12ZM32 40H24V32H16V24H8V16H16V8H24V16H32V24H40V32H32V40Z" fill="currentColor" />
                                        </svg>
                                        <div class="flex text-sm text-gray-600">
                                            <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                                <span>Click to upload</span>
                                                <input id="image" name="image" type="file" class="sr-only">
                                            </label>
                                            <p class="pl-1">or drag and drop</p>
                                        </div>
                                        <p class="text-xs text-gray-500">
                                            PNG, JPG, GIF up to 2MB
                                        </p>
                                    </div>
                                </div>
                                @if ($product->image)
                                    <div class="mt-2 flex justify-left">
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="relative bg-white border border-white rounded-lg overflow-hidden shadow-md h-40 w-60 flex items-center justify-center">
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="mt-6 flex justify-end">
                            <button type="submit" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-lg shadow">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
