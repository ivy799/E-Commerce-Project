<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 light:text-gray-200 leading-tight">
            {{ __('Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white light:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 light:text-gray-100">
                    @foreach ($orders as $order)
                        <div class="mb-4 p-4 bg-white light:bg-gray-700 rounded-lg shadow-md">
                            <h3 class="text-lg font-semibold">{{ __('Order ID:') }} {{ $order->id }}</h3>
                            <p>{{ __('Order Date:') }} {{ $order->order_date }}</p>
                            <p>{{ __('Status:') }} 
                                <span class="px-2 py-1 rounded-full text-white {{ $order->status === 'Pending' ? 'bg-yellow-500' : 'bg-green-500' }}">
                                    {{ $order->status }}
                                </span>
                            </p>
                            <p>{{ __('Total Amount:') }} ${{ $order->total_amount }}</p>
                            <h4 class="mt-2">{{ __('Order Details:') }}</h4>
                            <ul class="list-disc list-inside">
                                @foreach ($order->orderDetails as $detail)
                                    <li>{{ $detail->product->name }} - {{ $detail->quantity }} x ${{ $detail->price }}</li>
                                @endforeach
                            </ul>
                            @if ($order->status === 'Pending')
                                <form action="{{ route('seller.orders.ship', $order->id) }}" method="POST" class="mt-4">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow">
                                        {{ __('Ship Order') }}
                                    </button>
                                </form>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>