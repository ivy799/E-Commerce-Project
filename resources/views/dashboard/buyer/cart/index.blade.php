<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your Cart') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(session('success'))
                        <div class="mb-4 text-green-600">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(!$cartItems->isEmpty())
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Select</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($cartItems as $item)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <input type="checkbox" name="cart_items[]" value="{{ $item->id }}">
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ $item->product->name }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <!-- Form Update -->
                                            <form action="{{ route('buyer.cart.update', $item->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <input type="number" name="amount" value="{{ $item->amount }}" min="1" class="text-sm text-gray-900">
                                                <button type="submit" class="ml-2 bg-blue-500 hover:bg-blue-600 text-white font-semibold py-1 px-2 rounded-lg shadow">Update</button>
                                            </form>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">${{ number_format($item->product->price, 2) }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <form action="{{ route('buyer.cart.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-lg shadow">
                                                    Remove
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Form Checkout -->
                        <form action="{{ route('buyer.orders.checkout') }}" method="POST" class="mt-6">
                            @csrf
                            <div id="selected-cart-items"></div>
                            <button type="submit" id="checkout-button" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg shadow" disabled>Checkout</button>
                        </form>

                        <script>
                            // Get references to checkboxes and the checkout button
                            const checkboxes = document.querySelectorAll('input[name="cart_items[]"]');
                            const checkoutButton = document.getElementById('checkout-button');

                            // Function to check if any checkbox is selected
                            function updateCheckoutButtonState() {
                                const anyChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);
                                checkoutButton.disabled = !anyChecked;
                            }

                            // Update button state on page load and whenever a checkbox changes
                            updateCheckoutButtonState();
                            checkboxes.forEach(checkbox => {
                                checkbox.addEventListener('change', updateCheckoutButtonState);
                            });

                            // Add selected items to hidden inputs for checkout form
                            checkboxes.forEach(checkbox => {
                                checkbox.addEventListener('change', function() {
                                    const selectedCartItems = document.getElementById('selected-cart-items');
                                    selectedCartItems.innerHTML = '';
                                    document.querySelectorAll('input[name="cart_items[]"]:checked').forEach(checkedBox => {
                                        const hiddenInput = document.createElement('input');
                                        hiddenInput.type = 'hidden';
                                        hiddenInput.name = 'cart_items[]';
                                        hiddenInput.value = checkedBox.value;
                                        selectedCartItems.appendChild(hiddenInput);
                                    });
                                });
                            });
                        </script>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
