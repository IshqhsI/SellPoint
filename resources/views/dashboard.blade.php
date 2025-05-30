<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ 'Dashboard' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6 gap-4">
                        <div>
                            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">🧾 Dashboard Kasir</h1>
                            <p class="text-gray-500 text-sm">Ringkasan transaksi dan performa harian</p>
                        </div>

                        <a href="{{ route('home') }}"
                            class="inline-flex items-center px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-xl shadow transition duration-300">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 17v-2a2 2 0 012-2h2a2 2 0 012 2v2m4 0v-2a6 6 0 00-6-6H9a6 6 0 00-6 6v2m6-4h.01">
                                </path>
                            </svg>
                            Buka Halaman Kasir
                        </a>
                    </div>

                    <!-- Summary Cards -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                        <div
                            class="bg-white border border-indigo-600 rounded-xl p-4 shadow hover:shadow-lg transition">
                            <p class="text-sm text-gray-500">Penjualan Hari Ini</p>
                            <p class="text-xl font-bold mt-1 text-indigo-600">{{ "Rp. " . number_format($salesToday) }}</p>
                        </div>
                        <div
                            class="bg-white border border-indigo-600 rounded-xl p-4 shadow hover:shadow-lg transition">
                            <p class="text-sm text-gray-500">Produk Terjual Hari Ini</p>
                            <p class="text-xl font-bold mt-1 text-indigo-600">{{ $soldProductsCount }}</p>
                        </div>
                        <div
                            class="bg-white border border-indigo-600 rounded-xl p-4 shadow hover:shadow-lg transition">
                            <p class="text-sm text-gray-500">Produk</p>
                            <p class="text-xl font-bold mt-1 text-indigo-600">{{ $productsCount }}</p>
                        </div>
                        <div
                            class="bg-white border border-indigo-600 rounded-xl p-4 shadow hover:shadow-lg transition">
                            <p class="text-sm text-gray-500">Transaksi</p>
                            <p class="text-xl font-bold mt-1 text-indigo-600">{{ $transactionsCount }}</p>
                        </div>
                    </div>

                    <!-- Charts -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        <!-- Mingguan -->
                        <div class="bg-white rounded-lg shadow p-4">
                            <h2 class="text-base font-semibold text-gray-800 mb-2">Grafik Penjualan Mingguan</h2>
                            <div class="w-full h-[250px]">
                                <canvas id="weeklyChart"></canvas>
                            </div>
                        </div>

                        <!-- Bulanan -->
                        <div class="bg-white rounded-lg shadow p-4">
                            <h2 class="text-base font-semibold text-gray-800 mb-2">Grafik Penjualan Bulanan</h2>
                            <div class="w-full h-[250px]">
                                <canvas id="monthlyChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const weeklyCtx = document.getElementById('weeklyChart').getContext('2d');
        new Chart(weeklyCtx, {
            type: 'line',
            data: {
                labels: @json($weeklyLabels),
                datasets: [{
                    label: 'Mingguan',
                    data: @json($weeklyData),
                    borderColor: 'rgba(99, 102, 241, 1)',
                    backgroundColor: 'rgba(99, 102, 241, 0.15)',
                    fill: true,
                    tension: 0.4,
                    pointRadius: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: val => 'Rp ' + val.toLocaleString('id-ID'),
                            font: {
                                size: 10
                            }
                        }
                    },
                    x: {
                        ticks: {
                            font: {
                                size: 10
                            }
                        }
                    }
                }
            }
        });

        const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
        new Chart(monthlyCtx, {
            type: 'bar',
            data: {
                labels: @json($monthlyLabels),
                datasets: [{
                    label: 'Bulanan',
                    data: @json($monthlyData),
                    backgroundColor: 'rgba(99, 102, 241, 0.6)',
                    borderRadius: 5,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: val => 'Rp ' + val.toLocaleString('id-ID'),
                            font: {
                                size: 10
                            }
                        }
                    },
                    x: {
                        ticks: {
                            font: {
                                size: 10
                            }
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>
