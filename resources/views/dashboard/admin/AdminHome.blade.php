<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-light-800 dark:text-light-200 leading-tight">
            {{ __('WELCOME HOME ')}} 
            <span class="bg-gradient-to-r from-green-400 via-blue-500 to-purple-600 bg-clip-text text-transparent">
                {{ strtoupper($adminName) }}
            </span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="grid grid-cols-3 gap-6 text-center">
                    <!-- Card 1 -->
                    <div class="bg-gradient-to-r from-lime-500 to-green-400 p-6 rounded-lg shadow-md text-white transform hover:scale-105 transition-transform duration-300">
                        <div class="flex items-center justify-center space-x-4">
                            <div>
                                <h3 class="text-lg font-semibold">Total User</h3>
                                <p class="text-3xl font-bold">{{ $userCount - 1 }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="bg-gradient-to-r from-blue-400 to-blue-600 p-6 rounded-lg shadow-md text-white transform hover:scale-105 transition-transform duration-300">
                        <div class="flex items-center justify-center space-x-4">
                            <div>
                                <h3 class="text-lg font-semibold">Total Product</h3>
                                <p class="text-3xl font-bold">{{ $productCount }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="bg-gradient-to-r from-purple-400 to-purple-600 p-6 rounded-lg shadow-md text-white transform hover:scale-105 transition-transform duration-300">
                        <div class="flex items-center justify-center space-x-4">
                            <div>
                                <h3 class="text-lg font-semibold">Total Store</h3>
                                <p class="text-3xl font-bold">{{ $storeCount }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Web Traffic Chart -->
                <div class="mt-8">
                    <h3 class="text-2xl font-semibold mb-4 text-gray-800">Web Traffic</h3>
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
                    borderWidth: 2,
                    pointRadius: 4,
                    pointBackgroundColor: 'rgba(75, 192, 192, 1)',
                }]
            },
            options: {
                responsive: true,
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
