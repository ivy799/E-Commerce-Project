<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Store') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('seller.stores.update', $store->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 gap-6 mt-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                                <input type="text" name="name" value="{{ old('name', $store->name) }}" class="mt-1 block w-full text-black" required>
                                @error('name')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Location</label>
                                <input type="text" name="location" value="{{ old('location', $store->location) }}" class="mt-1 block w-full text-black">
                                @error('location')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                                <input type="email" name="email" value="{{ old('email', $store->email) }}" class="mt-1 block w-full text-black">
                                @error('email')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Image</label>
                                @if ($store->image)
                                    <img src="{{ asset('storage/' . $store->image) }}" alt="{{ $store->name }}" class="h-32 w-32 object-cover mb-4">
                                @endif
                                <input type="file" name="image" class="mt-1 block w-full text-black">
                                @error('image')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Update Store</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>