<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 light:text-gray-200 leading-tight border-b border-gray-200 light:border-gray-700 pb-4">
            YOUR ORDERS
        </h2>
        <h1 class="font-semibold text-xl text-gray-800 light:text-gray-200 leading-tight border-b border-gray-200 light:border-gray-700 pb-4">
            YOUR ORDERS
        </h1>

    </x-slot> --}}

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white light:bg-gray-800 overflow-hidden shadow-lg rounded-lg">
                <div class="p-6 bg-white light:bg-gray-800 border-b border-gray-200 light:border-gray-700">
                    <form action="{{ route('buyer.orders.index') }}" method="GET" class="mb-6">
                        <div class="flex items-center space-x-4">
                            <select name="status" class="form-select block w-full mt-1">
                                <option value="">All Statuses</option>
                                <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Shipped" {{ request('status') == 'Shipped' ? 'selected' : '' }}>Shipped</option>
                            </select>
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                                Filter
                            </button>
                        </div>
                    </form>
                    @if($orders->isEmpty())
                        <div class="flex flex-col items-center justify-center py-10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400 light:text-gray-600 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h18M9 3v18m6-18v18M3 21h18" />
                            </svg>
                            <p class="text-gray-600 light:text-gray-400 text-lg">You have no orders.</p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 light:divide-gray-700">
                                <thead class="bg-gray-50 light:bg-gray-700">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 light:text-gray-300 uppercase tracking-wider">
                                            Order ID
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 light:text-gray-300 uppercase tracking-wider">
                                            Order Date
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 light:text-gray-300 uppercase tracking-wider">
                                            Status
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 light:text-gray-300 uppercase tracking-wider">
                                            Total Amount
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 light:text-gray-300 uppercase tracking-wider">
                                            Details
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white light:bg-gray-800 divide-y divide-gray-200 light:divide-gray-700">
                                    @foreach($orders as $order)
                                        @if(request('status') == '' || request('status') == $order->status)
                                            <tr class="hover:bg-gray-100 light:hover:bg-gray-700">
                                                <td class="px-6 py-4 whitespace-nowrap text-gray-700 light:text-gray-300">
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-gray-700 light:text-gray-300">
                                                    {{ $order->order_date }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-gray-700 light:text-gray-300">
                                                    {{ $order->status }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-gray-700 light:text-gray-300">
                                                    ${{ number_format($order->total_amount, 2) }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <a href="{{ route('buyer.orders.show', $order->id) }}" class="text-blue-600 light:text-blue-400 flex items-center space-x-2">
                                                        <span>View Details</span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                                        </svg>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
