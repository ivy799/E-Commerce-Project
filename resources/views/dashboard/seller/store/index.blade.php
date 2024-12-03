<x-app-layout>
    <div class="py-12">
        <div class="px-6 lg:px-8">
            <div class="bg-white light:bg-gray-800 overflow-hidden shadow-md rounded-lg w-full">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 light:text-gray-100 mb-4">Store Profile</h3>
                    @forelse($stores as $store)
                        <div class="flex flex-wrap items-center space-x-6">
                            <!-- Store Image -->
                            <div class="flex-shrink-0">
                                @if ($store->image)
                                    <img src="{{ asset('storage/' . $store->image) }}" alt="{{ $store->name }}" class="h-24 w-24 rounded-full object-cover">
                                @else
                                    <div class="h-24 w-24 flex items-center justify-center bg-gray-200 rounded-full">
                                        <span class="text-gray-500">No Image</span>
                                    </div>
                                @endif
                            </div>

                            <!-- Store Details -->
                            <div class="flex-1">
                                <div class="mb-2">
                                    <h4 class="text-xl font-medium text-gray-800 light:text-gray-200">{{ $store->name }}</h4>
                                    <p class="text-sm text-gray-500 light:text-gray-400">{{ $store->email }}</p>
                                </div>
                                <p class="text-gray-700 light:text-gray-300">{{ $store->address }}</p>
                            </div>
                        </div>

                        <!-- Store Description -->
                        <div class="mt-4">
                            <h5 class="text-md font-semibold text-gray-800 light:text-gray-200">Description</h5>
                            <p class="text-gray-700 light:text-gray-300">{{ $store->description }}</p>
                        </div>

                        <!-- Actions -->
                        <div class="mt-6 flex justify-end">
                            <a href="{{ route('seller.stores.edit', $store->id) }}" class="px-4 py-2 bg-black text-white rounded-md hover:bg-black">
                                Edit Store
                            </a>
                        </div>
                    @empty
                        <div class="text-center py-6">
                            <p class="text-gray-500 light:text-gray-400">No stores found</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
