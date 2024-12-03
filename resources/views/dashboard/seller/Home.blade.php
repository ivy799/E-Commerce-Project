<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <!-- Grid Cards -->
                <div class="grid grid-cols-3 gap-6 p-6">
                    <!-- Card 1 -->
                    <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200 hover:shadow-lg hover:scale-105 transition duration-300 ease-in-out">
                        <div class="flex items-center">
                            <div class="text-left">
                                <h3 class="text-lg font-semibold text-gray-700">Total Products</h3>
                                <p class="text-3xl font-bold text-gray-900">{{$productCount}}</p>
                            </div>
                        </div>
                    </div>
                    <!-- Card 2 -->
                    <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200 hover:shadow-lg hover:scale-105 transition duration-300 ease-in-out">
                        <div class="flex items-center">
                            <div class="text-left">
                                <h3 class="text-lg font-semibold text-gray-700">Total Orders</h3>
                                <p class="text-3xl font-bold text-gray-900">{{$orderCount}}</p>
                            </div>
                        </div>
                    </div>
                    <!-- Card 3 -->
                    <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200 hover:shadow-lg hover:scale-105 transition duration-300 ease-in-out">
                        <div class="flex items-center">
                            <div class="text-left">
                                <h3 class="text-lg font-semibold text-gray-700">Total Revenue</h3>
                                <p class="text-3xl font-bold text-gray-900">${{number_format($totalRevenue, 2)}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Chart Section -->
                <div class="mt-6">
                    <h3 class="text-2xl font-semibold text-gray-800 mb-4">Orders Per Day</h3>
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
                    borderWidth: 2
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
