<x-app-layout>
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">All Products</h1>
        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-100 text-gray-700 uppercase text-sm">
                    <tr>
                        <th class="px-6 py-3">Image</th>
                        <th class="px-6 py-3">Name</th>
                        {{-- <th class="px-6 py-3">Description</th> --}}
                        <th class="px-6 py-3">Price</th>
                        <th class="px-6 py-3">Stock</th>
                        <th class="px-6 py-3">Category</th>
                        <th class="px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($products as $product)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-16 h-16 rounded object-cover">
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $product->name }}</td>
                            {{-- <td class="px-6 py-4">{{ $product->description }}</td> --}}
                            <td class="px-6 py-4 text-gray-700">Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 text-gray-700">{{ $product->stock }}</td>
                            <td class="px-6 py-4 text-gray-700">{{ $product->category }}</td>
                            <td class="px-6 py-4">
                                <form action="{{ route('seller.products.destroy', $product->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-6 h-6" viewBox="0 -960 960 960" fill="currentColor">
                                            <path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/>
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
