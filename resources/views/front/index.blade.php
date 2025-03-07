@extends('layouts.front')
@section('content')

    <!-- Main Content -->
    <div class="md:flex flex-1 overflow-auto">
        <!-- Left Panel - Products -->
        <div class="w-full lg:w-2/3 flex flex-col bg-white shadow-md">

            <!-- Search and Date -->
            <div
                class="p-4 border-b border-gray-100 flex flex-col-reverse md:flex-row justify-between items-center space-y-4 gap-4">

                <div class="relative w-full md:w-96 mb-0">
                    <input type="text" placeholder="Cari produk (nama/kode/barcode)..."
                        class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>

                <div class="flex items-end md:items-center space-x-4">
                    <div class="text-right">
                        <p class="text-sm text-gray-600">Jumat</p>
                        <p class="text-gray-800 font-medium">07 Maret 2025</p>
                    </div>
                    <button class="bg-blue-50 text-blue-600 p-2 rounded-lg hover:bg-blue-100 transition">
                        <i class="fas fa-qrcode text-lg"></i>
                    </button>
                </div>
            </div>

            <!-- Categories -->
            <div class="p-4 overflow-x-auto scrollbar-hide border-b border-gray-100">
                <div class="flex space-x-2">
                    <button
                        class="category-pill flex items-center px-4 lg:py-2 rounded-full bg-blue-600 text-white font-medium">
                        <i class="fas fa-border-all mr-2"></i>
                        All
                    </button>
                    <button
                        class="category-pill flex items-center px-4 lg:py-2 rounded-full bg-white text-gray-700 border border-gray-200 font-medium">
                        <i class="fas fa-utensils mr-2 text-yellow-500"></i>
                        Makanan
                    </button>
                    <button
                        class="category-pill flex items-center px-4 lg:py-2 rounded-full bg-white text-gray-700 border border-gray-200 font-medium">
                        <i class="fas fa-coffee mr-2 text-amber-600"></i>
                        Minuman
                    </button>
                    <button
                        class="category-pill flex items-center px-4 lg:py-2 rounded-full bg-white text-gray-700 border border-gray-200 font-medium">
                        <i class="fas fa-shopping-basket mr-2 text-green-600"></i>
                        Sembako
                    </button>
                    <button
                        class="category-pill flex items-center px-4 lg:py-2 rounded-full bg-white text-gray-700 border border-gray-200 font-medium">
                        <i class="fas fa-bolt mr-2 text-purple-600"></i>
                        Elektronik
                    </button>
                    <button
                        class="category-pill flex items-center px-4 py-2 rounded-full bg-white text-gray-700 border border-gray-200 font-medium">
                        <i class="fas fa-spray-can mr-2 text-pink-500"></i>
                        Kosmetik
                    </button>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="p-4 overflow-auto flex-1 bg-gray-50">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                    <!-- Product 1 -->
                    <div class="product-card bg-white rounded-xl shadow-sm hover:shadow-md overflow-hidden">
                        <div class="h-40 bg-gray-100 relative overflow-hidden flex items-center justify-center p-4">
                            <img src="https://placehold.co/600x400" alt="Indomie Goreng" class="w-auto object-contain">
                            <span
                                class="absolute top-2 right-2 bg-yellow-400 text-xs font-bold text-yellow-800 py-1 px-2 rounded">Terlaris</span>
                        </div>
                        <div class="p-3">
                            <h3 class="font-medium text-gray-800 truncate">Indomie Goreng</h3>
                            <div class="flex justify-between items-center mt-1">
                                <span class="text-blue-600 font-bold">Rp 3.500</span>
                                <span class="text-xs bg-blue-50 text-blue-600 py-1 px-2 rounded">Stok: 42</span>
                            </div>
                        </div>
                    </div>

                    <!-- Product 2 -->
                    <div class="product-card bg-white rounded-xl shadow-sm hover:shadow-md overflow-hidden">
                        <div class="h-40 bg-gray-100 relative overflow-hidden flex items-center justify-center p-4">
                            <img src="https://placehold.co/600x400" alt="Teh Botol" class=" w-auto object-contain">
                        </div>
                        <div class="p-3">
                            <h3 class="font-medium text-gray-800 truncate">Teh Botol Sosro 350ml</h3>
                            <div class="flex justify-between items-center mt-1">
                                <span class="text-blue-600 font-bold">Rp 5.000</span>
                                <span class="text-xs bg-blue-50 text-blue-600 py-1 px-2 rounded">Stok: 24</span>
                            </div>
                        </div>
                    </div>

                    <!-- Product 3 -->
                    <div class="product-card bg-white rounded-xl shadow-sm hover:shadow-md overflow-hidden">
                        <div class="h-40 bg-gray-100 relative overflow-hidden flex items-center justify-center p-4">
                            <img src="https://placehold.co/600x400" alt="Beras Premium" class=" w-auto object-contain">
                            <span
                                class="absolute top-2 right-2 bg-green-400 text-xs font-bold text-green-800 py-1 px-2 rounded">Promo</span>
                        </div>
                        <div class="p-3">
                            <h3 class="font-medium text-gray-800 truncate">Beras Premium 5kg</h3>
                            <div class="flex justify-between items-center mt-1">
                                <span class="text-blue-600 font-bold">Rp 65.000</span>
                                <span class="text-xs bg-blue-50 text-blue-600 py-1 px-2 rounded">Stok: 15</span>
                            </div>
                        </div>
                    </div>

                    <!-- Product 4 -->
                    <div class="product-card bg-white rounded-xl shadow-sm hover:shadow-md overflow-hidden">
                        <div class="h-40 bg-gray-100 relative overflow-hidden flex items-center justify-center p-4">
                            <img src="https://placehold.co/600x400" alt="Sabun Mandi" class=" w-auto object-contain">
                        </div>
                        <div class="p-3">
                            <h3 class="font-medium text-gray-800 truncate">Sabun Mandi Lifebuoy</h3>
                            <div class="flex justify-between items-center mt-1">
                                <span class="text-blue-600 font-bold">Rp 4.500</span>
                                <span class="text-xs bg-blue-50 text-blue-600 py-1 px-2 rounded">Stok: 36</span>
                            </div>
                        </div>
                    </div>

                    <!-- Product 5 -->
                    <div class="product-card bg-white rounded-xl shadow-sm hover:shadow-md overflow-hidden">
                        <div class="h-40 bg-gray-100 relative overflow-hidden flex items-center justify-center p-4">
                            <img src="https://placehold.co/600x400" alt="Kopi Sachet" class=" w-auto object-contain">
                        </div>
                        <div class="p-3">
                            <h3 class="font-medium text-gray-800 truncate">Kopi ABC Sachet</h3>
                            <div class="flex justify-between items-center mt-1">
                                <span class="text-blue-600 font-bold">Rp 2.000</span>
                                <span class="text-xs bg-blue-50 text-blue-600 py-1 px-2 rounded">Stok: 50</span>
                            </div>
                        </div>
                    </div>

                    <!-- Product 6 -->
                    <div class="product-card bg-white rounded-xl shadow-sm hover:shadow-md overflow-hidden">
                        <div class="h-40 bg-gray-100 relative overflow-hidden flex items-center justify-center p-4">
                            <img src="https://placehold.co/600x400" alt="Minyak Goreng" class=" w-auto object-contain">
                            <span
                                class="absolute top-2 right-2 bg-red-400 text-xs font-bold text-red-800 py-1 px-2 rounded">Hemat
                                10%</span>
                        </div>
                        <div class="p-3">
                            <h3 class="font-medium text-gray-800 truncate">Minyak Goreng Bimoli 1L</h3>
                            <div class="flex justify-between items-center mt-1">
                                <div>
                                    <span class="text-blue-600 font-bold">Rp 18.500</span>
                                    <span class="text-xs text-gray-500 line-through ml-1">Rp 20.500</span>
                                </div>
                                <span class="text-xs bg-blue-50 text-blue-600 py-1 px-2 rounded">Stok: 20</span>
                            </div>
                        </div>
                    </div>

                    <!-- Product 7 -->
                    <div class="product-card bg-white rounded-xl shadow-sm hover:shadow-md overflow-hidden">
                        <div class="h-40 bg-gray-100 relative overflow-hidden flex items-center justify-center p-4">
                            <img src="https://placehold.co/600x400" alt="Susu UHT" class=" w-auto object-contain">
                        </div>
                        <div class="p-3">
                            <h3 class="font-medium text-gray-800 truncate">Susu Ultra 1L</h3>
                            <div class="flex justify-between items-center mt-1">
                                <span class="text-blue-600 font-bold">Rp 16.500</span>
                                <span class="text-xs bg-blue-50 text-blue-600 py-1 px-2 rounded">Stok: 18</span>
                            </div>
                        </div>
                    </div>

                    <!-- Product 8 -->
                    <div class="product-card bg-white rounded-xl shadow-sm hover:shadow-md overflow-hidden">
                        <div class="h-40 bg-gray-100 relative overflow-hidden flex items-center justify-center p-4">
                            <img src="https://placehold.co/600x400" alt="Pasta Gigi" class=" w-auto object-contain">
                        </div>
                        <div class="p-3">
                            <h3 class="font-medium text-gray-800 truncate">Pasta Gigi Pepsodent</h3>
                            <div class="flex justify-between items-center mt-1">
                                <span class="text-blue-600 font-bold">Rp 12.000</span>
                                <span class="text-xs bg-blue-50 text-blue-600 py-1 px-2 rounded">Stok: 22</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Panel - Cart -->
        <div class="w-full lg:w-1/3 flex flex-col bg-white border-l border-gray-200">
            <!-- Cart Header -->
            <div class="bg-gray-50 p-4 border-b border-gray-200">
                <h2 class="font-bold text-gray-800">Keranjang Belanja</h2>
                <div class="flex justify-between mt-1">
                    <p class="text-sm text-gray-500">Transaksi #INV-20250307-001</p>
                    <button class="text-red-600 text-sm hover:text-red-700">
                        <i class="fas fa-trash-alt mr-1"></i>
                        Kosongkan
                    </button>
                </div>
            </div>

            <!-- Cart Items -->
            <div class="flex-1 overflow-y-auto p-3 space-y-3">
                <!-- Cart Item 1 -->
                <div class="bg-white rounded-lg p-3 border border-gray-100 shadow-sm flex gap-3">
                    <img src="/api/placeholder/60/60" alt="Indomie" class="h-16 w-16 object-cover rounded bg-gray-100">
                    <div class="flex-1">
                        <div class="flex justify-between">
                            <h3 class="font-medium text-gray-800">Indomie Goreng</h3>
                            <button class="text-gray-400 hover:text-red-500">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="text-gray-600 text-sm">SKU: MKIN001</div>
                        <div class="flex justify-between items-center mt-2">
                            <div class="text-blue-600 font-bold">Rp 3.500</div>
                            <div class="flex items-center border rounded overflow-hidden">
                                <button class="px-2 py-1 bg-gray-100 hover:bg-gray-200 text-gray-700">-</button>
                                <input type="number" value="2"
                                    class="w-10 py-1 text-center border-l border-r border-gray-200 focus:outline-none">
                                <button class="px-2 py-1 bg-gray-100 hover:bg-gray-200 text-gray-700">+</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cart Item 2 -->
                <div class="bg-white rounded-lg p-3 border border-gray-100 shadow-sm flex gap-3">
                    <img src="/api/placeholder/60/60" alt="Teh Botol" class="h-16 w-16 object-cover rounded bg-gray-100">
                    <div class="flex-1">
                        <div class="flex justify-between">
                            <h3 class="font-medium text-gray-800">Teh Botol Sosro 350ml</h3>
                            <button class="text-gray-400 hover:text-red-500">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="text-gray-600 text-sm">SKU: MNTH001</div>
                        <div class="flex justify-between items-center mt-2">
                            <div class="text-blue-600 font-bold">Rp 5.000</div>
                            <div class="flex items-center border rounded overflow-hidden">
                                <button class="px-2 py-1 bg-gray-100 hover:bg-gray-200 text-gray-700">-</button>
                                <input type="number" value="1"
                                    class="w-10 py-1 text-center border-l border-r border-gray-200 focus:outline-none">
                                <button class="px-2 py-1 bg-gray-100 hover:bg-gray-200 text-gray-700">+</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cart Item 3 -->
                <div class="bg-white rounded-lg p-3 border border-gray-100 shadow-sm flex gap-3">
                    <img src="/api/placeholder/60/60" alt="Sabun Mandi"
                        class="h-16 w-16 object-cover rounded bg-gray-100">
                    <div class="flex-1">
                        <div class="flex justify-between">
                            <h3 class="font-medium text-gray-800">Sabun Mandi Lifebuoy</h3>
                            <button class="text-gray-400 hover:text-red-500">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="text-gray-600 text-sm">SKU: KBSB001</div>
                        <div class="flex justify-between items-center mt-2">
                            <div class="text-blue-600 font-bold">Rp 4.500</div>
                            <div class="flex items-center border rounded overflow-hidden">
                                <button class="px-2 py-1 bg-gray-100 hover:bg-gray-200 text-gray-700">-</button>
                                <input type="number" value="2"
                                    class="w-10 py-1 text-center border-l border-r border-gray-200 focus:outline-none">
                                <button class="px-2 py-1 bg-gray-100 hover:bg-gray-200 text-gray-700">+</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Customer & Discount -->
            <div class="p-4 border-t border-gray-200 space-y-3">
                <div class="flex space-x-2">
                    <div class="flex-1">
                        <input type="text" placeholder="Nama Pelanggan"
                            class="w-full px-3 py-2 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    <div class="flex-1">
                        <input type="text" placeholder="Kode Diskon"
                            class="w-full px-3 py-2 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                </div>
            </div>

            <!-- Cart Summary -->
            <div class="p-4 bg-gray-50 border-t border-gray-200">
                <div class="space-y-2">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Subtotal</span>
                        <span class="font-medium">Rp 21.000</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Diskon</span>
                        <span class="font-medium text-green-600">- Rp 0</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Pajak (10%)</span>
                        <span class="font-medium">Rp 2.100</span>
                    </div>
                    <div class="border-t border-gray-200 pt-2 mt-2">
                        <div class="flex justify-between">
                            <span class="font-bold text-gray-800">Total</span>
                            <span class="font-bold text-lg text-blue-600">Rp 23.100</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Methods -->
            <div class="p-4 border-t border-gray-200">
                <h3 class="font-medium text-gray-700 mb-3">Metode Pembayaran</h3>
                <div class="grid grid-cols-3 gap-2 mb-4">
                    <button
                        class="payment-method-button border border-blue-500 bg-blue-50 py-2 rounded-lg text-center text-blue-600 font-medium">
                        <i class="fas fa-money-bill-wave text-blue-500 mr-1"></i>
                        Tunai
                    </button>
                    <button
                        class="payment-method-button border border-gray-200 py-2 rounded-lg text-center text-gray-700 font-medium">
                        <i class="fas fa-credit-card text-gray-500 mr-1"></i>
                        Kartu
                    </button>
                    <button
                        class="payment-method-button border border-gray-200 py-2 rounded-lg text-center text-gray-700 font-medium">
                        <i class="fas fa-qrcode text-gray-500 mr-1"></i>
                        QRIS
                    </button>
                </div>

                <button
                    class="w-full py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold rounded-lg shadow-md transition duration-300 flex items-center justify-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    Proses Pembayaran
                </button>

                <div class="flex justify-center mt-3">
                    <button class="text-sm text-gray-600 hover:text-blue-600 transition">
                        <i class="fas fa-print mr-1"></i>
                        Cetak Struk Terakhir
                    </button>
                </div>
            </div>
        </div>

    </div>
@endsection
