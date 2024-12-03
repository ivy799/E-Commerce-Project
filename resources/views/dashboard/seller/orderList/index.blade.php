<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach ($orders as $order)
                            <div class="p-4 bg-gray-100 border rounded-lg shadow-md">
                                <div class="flex justify-between items-center mb-4">
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-800">{{ __('Order ID:') }} {{ $order->id }}</h3>
                                        <p class="text-sm text-gray-600">{{ __('Order Date:') }} {{ $order->order_date }}</p>
                                    </div>
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full 
                                        {{ $order->status === 'Pending' ? 'bg-yellow-500 text-white' : 'bg-green-500 text-white' }}">
                                        {{ $order->status }}
                                    </span>
                                </div>
                                <div class="mb-4">
                                    <p class="text-sm text-gray-600"><strong>{{ __('Total Amount:') }}</strong> ${{ $order->total_amount }}</p>
                                    <h4 class="mt-2 text-sm font-semibold text-gray-700">{{ __('Order Details:') }}</h4>
                                    <ul class="list-disc list-inside text-sm text-gray-600">
                                        @foreach ($order->orderDetails as $detail)
                                            <li>{{ $detail->product->name }} - {{ $detail->quantity }} x ${{ $detail->price }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @if ($order->status === 'Pending')
                                    @php
                                        $canShip = true;
                                        foreach ($order->orderDetails as $detail) {
                                            if ($detail->product->stock < $detail->quantity) {
                                                $canShip = false;
                                                break;
                                            }
                                        }
                                    @endphp
                                    <form action="{{ route('seller.orders.ship', $order->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="w-full {{ $canShip ? 'bg-blue-600 hover:bg-blue-700' : 'bg-red-600 hover:bg-red-700' }} text-white font-semibold py-2 px-4 rounded-lg shadow" {{ $canShip ? '' : 'disabled' }}>
                                            {{ $canShip ? __('Ship Order') : __('Out Of Stock') }}
                                        </button>
                                    </form>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
