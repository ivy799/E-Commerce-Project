<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @foreach ($orders as $order)
                        <div class="mb-4">
                            <h3 class="text-lg font-semibold">{{ __('Order ID:') }} {{ $order->id }}</h3>
                            <p>{{ __('Order Date:') }} {{ $order->order_date }}</p>
                            <p>{{ __('Status:') }} {{ $order->status }}</p>
                            <p>{{ __('Total Amount:') }} ${{ $order->total_amount }}</p>
                            <h4 class="mt-2">{{ __('Order Details:') }}</h4>
                            <ul>
                                @foreach ($order->orderDetails as $detail)
                                    <li>{{ $detail->product->name }} - {{ $detail->quantity }} x ${{ $detail->price }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
