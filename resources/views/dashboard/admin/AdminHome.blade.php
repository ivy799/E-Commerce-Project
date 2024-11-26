<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 light:text-gray-200 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot> --}}

    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="grid grid-cols-3 gap-4 p-6 text-center">
                    <div class="bg-white p-6 rounded-lg shadow-md border-solid border-2 border-black">
                        <div class="flex items-center justify-center">
                            <div class="ml-2 text-left">
                                <h3 class="text-xl font-semibold">Total User</h3>
                                <p class="text-2xl font-bold">{{ $userCount-1 }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-md border-solid border-2 border-black">
                        <div class="flex items-center justify-center">
                            <div class="ml-2 text-left">
                                <h3 class="text-xl font-semibold">Active Buyer</h3>
                                <p class="text-2xl font-bold">{{ $buyerCount }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-md border-solid border-2 border-black">
                        <div class="flex items-center justify-center">
                            <div class="ml-2 text-left">
                                <h3 class="text-xl font-semibold">Active Seller</h3>
                                <p class="text-2xl font-bold">{{ $sellerCount }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-4">
                    <h3 class="text-2xl font-semibold">Web Traffic</h3>
                    <canvas id="ordersChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('ordersChart').getContext('2d');
        const ordersPerDay = @json($ordersPerDay);

        const labels = ordersPerDay.map(order => order.date);
        const data = ordersPerDay.map(order => order.count);

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Orders Per Day',
                    data: data,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    x: {
                        type: 'time',
                        time: {
                            unit: 'day'
                        }
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>