<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 light:text-gray-200 leading-tight">
            {{ __('Manage Stores') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white light:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 light:text-gray-100">
                    <h3 class="text-lg font-medium text-gray-900 light:text-gray-100">Store Profile</h3>
                    <table class="min-w-full divide-y divide-gray-200 light:divide-gray-700">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 light:text-gray-400 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 light:text-gray-400 uppercase tracking-wider">address</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 light:text-gray-400 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 light:text-gray-400 uppercase tracking-wider">description</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 light:text-gray-400 uppercase tracking-wider">Image</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 light:text-gray-400 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white light:bg-gray-800 divide-y divide-gray-200 light:divide-gray-700">
                            @forelse($stores as $store)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $store->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $store->address }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $store->email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $store->description }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($store->image)
                                            <img src="{{ asset('storage/' . $store->image) }}" alt="{{ $store->name }}" class="h-16 w-16 object-cover">
                                        @else
                                            <span class="text-gray-500">No image available</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('seller.stores.edit', $store->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 whitespace-nowrap text-center">No stores found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>