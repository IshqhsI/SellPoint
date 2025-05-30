<div class="md:flex flex-1 overflow-auto">

    <!-- Left Panel - Products -->
    <div class="w-full lg:w-2/3 flex flex-col bg-white shadow-md">

        <!-- Search and Date -->
        <div
            class="p-4 border-b border-gray-100 flex flex-col-reverse md:flex-row justify-between items-center space-y-4 gap-4">

            <div class="relative w-full md:w-96 mb-0">
                <input type="text" placeholder="Cari produk (nama/kode/barcode)..." autofocus
                    class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    wire:model="search" wire:keydown="getBySearch">
                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
            </div>

            <div class="flex items-end md:items-center space-x-4">
                <div class="text-right">
                    <p class="text-sm text-gray-600">{{ Auth::user()->name }}</p>
                    <p class="text-gray-800 font-medium">{{ date('d M Y') }}</p>
                </div>
                <button class="bg-blue-50 text-blue-600 p-2 rounded-lg hover:bg-blue-100 transition">
                    <i class="fas fa-qrcode text-lg"></i>
                </button>
            </div>
        </div>

        <!-- Categories -->
        <div x-data="{ activeCategory: 'all' }" class="p-4 overflow-x-auto scrollbar-hide border-b border-gray-100">
            <div class="flex space-x-2 overflow-auto scrollbar-hide">
                <button @click="activeCategory = 'all'" class="flex items-center px-4 lg:py-2 rounded-full font-medium"
                    :class="activeCategory === 'all' ? 'bg-blue-600 text-white' :
                        'bg-white text-gray-700 border border-gray-200'"
                    wire:click="getAllProducts">
                    <i class="fas fa-border-all mr-2"></i>
                    All
                </button>
                @foreach ($categories as $category)
                    <button @click="activeCategory = {{ $category->id }}"
                        class="whitespace-nowrap category-pill flex items-center px-4 lg:py-2 rounded-full border border-gray-200 font-medium"
                        :class="activeCategory == '{{ $category->id }}' ? 'bg-blue-600 text-white hover:bg-blue-600' :
                            'bg-white text-gray-700 border border-gray-200'"
                        wire:click="getByCategory({{ $category->id }})">
                        {{ $category->name }}
                    </button>
                @endforeach
            </div>
        </div>

        <!-- Products Grid -->
        <div class="p-2 overflow-auto flex-1 bg-gray-50">
            @if (count($products) > 0)
                <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 gap-2 lg:gap-4">
                    @foreach ($products as $product)
                        <div class="product-card bg-white rounded-xl shadow-sm hover:shadow-md overflow-hidden">
                            <div class="h-40 bg-gray-100 relative overflow-hidden flex items-center justify-center p-4">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                    class="w-auto object-contain" loading="lazy">
                                {{-- <span
                                        class="absolute top-2 right-2 bg-yellow-400 text-xs font-bold text-yellow-800 py-1 px-2 rounded">Terlaris</span> --}}
                            </div>
                            <div class="p-3">
                                <h3 class="font-medium text-gray-800 truncate text-sm">{{ $product->name }}</h3>
                                <div class="flex justify-between items-center mt-1">
                                    <span
                                        class="text-blue-600 font-bold">{{ 'Rp. ' . number_format($product->price) }}</span>
                                    <button type="button"
                                        class="bg-blue-600 text-white py-1 px-3 rounded-lg hover:bg-blue-700 transition"
                                        wire:click="addToCart({{ $product->id }})">
                                        <i class="fas fa-cart-plus mr-1"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div
                    class="bg-white rounded-lg p-3 border border-gray-100 shadow-sm h-full flex justify-center items-center">
                    <div class="flex justify-center items-center">
                        <h3 class="font-medium text-gray-800 text-lg">Tidak ada produk yang tersedia.</h3>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Right Panel - Cart -->
    <div class="w-full lg:w-1/3 flex flex-col bg-white border-l border-gray-200" id="cartSection">

        <!-- Cart Header -->
        <div class="bg-gray-50 p-4 border-b border-gray-200 flex justify-between">
            <h2 class="font-bold text-gray-800">Keranjang Belanja</h2>
            {{-- <div class="flex justify-between mt-1">
                    <p class="text-sm text-gray-500">Transaksi #INV-20250307-001</p>
                </div> --}}
            <button class="text-red-600 text-sm hover:text-red-700" wire:click="emptyCart">
                <i class="fas fa-trash-alt mr-1"></i>
                Kosongkan
            </button>
        </div>

        <!-- Cart Items -->
        <div class="flex-1 overflow-y-auto p-3 space-y-3 max-h-[calc(100vh-300px)]">
            @if (count($cart) > 0)
                @foreach ($cart as $index => $item)
                    <div class="bg-white rounded-lg p-3 border border-gray-100 shadow-sm flex gap-3">
                        <img src="{{ asset('storage/' . $item['image']) }}" alt="" loading="lazy"
                            class="h-16 w-16 my-auto object-cover rounded bg-gray-100">
                        <div class="flex-1">
                            <div class="flex justify-between">
                                <h3 class="font-medium text-gray-800">{{ $item['name'] }}</h3>
                                <button class="text-gray-400 hover:text-red-500">
                                    <i class="fas fa-times" wire:click="removeFromCart({{ $index }})"></i>
                                </button>
                            </div>
                            {{-- <div class="text-gray-600 text-sm">SKU: MKIN001</div> --}}
                            <div class="flex justify-between items-center mt-2">
                                <div class="text-blue-600 font-bold">{{ 'Rp. ' . number_format($item['price']) }}</div>
                                <div class="flex items-center border border-slate-300 rounded-lg overflow-hidden">
                                    <button class="px-2 py-1 bg-blue-500 hover:bg-blue-500 rounded-s-md text-gray-50"
                                        wire:click="decrementQuantity({{ $index }})">-</button>
                                    <span class="w-10 py-1 text-center outline-none">{{ $item['quantity'] }}</span>
                                    <button class="px-2 py-1 bg-blue-500 hover:bg-blue-500 rounded-e-md  text-gray-50"
                                        wire:click="incrementQuantity({{ $index }})">+</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div
                    class="bg-white rounded-lg p-3 border border-gray-100 shadow-sm h-full flex justify-center items-center">
                    <div class="flex justify-center items-center">
                        <i class="fas fa-cart-plus mr-1"></i>
                        <h3 class="font-medium text-gray-800 text-lg">Keranjang Kosong</h3>
                    </div>
                </div>
            @endif

        </div>

        <!-- Cart Summary -->
        <div class="p-4 py-2 bg-gray-50 border-t border-gray-200">
            <div class="space-y-2">
                {{-- <div class="flex justify-between text-sm">
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
                    </div> --}}
                <div class="border-t border-gray-200 pt-4 mt-2">
                    <div class="flex items-center justify-between">
                        <span class="font-bold text-lg text-gray-800">Total</span>
                        <span class="font-bold text-lg text-blue-600">Rp. {{ number_format($total) }} </span>
                    </div>
                </div>
                <div class="flex justify-between items-center text-sm">
                    <span class="text-gray-600">Cash</span>
                    <input type="text" id="cash"
                        class="text-right text-blue-600 font-bold text-lg rounded border-0 border-gray-300 focus:outline-none focus:border-transparent"
                        wire:model="cash" wire:keyup="calculateChange" placeholder="0">
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Change</span>
                    <span class="font-bold text-lg text-blue-600">Rp. {{ number_format($change) }} </span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-4 gap-2 mt-3 p-2">
            <button wire:click="addCash(1000)" class="bg-blue-100 text-xs rounded py-1">1K</button>
            <button wire:click="addCash(2000)" class="bg-blue-100 text-xs rounded py-1">2K</button>
            <button wire:click="addCash(5000)" class="bg-blue-100 text-xs rounded py-1">5K</button>
            <button wire:click="addCash(10000)" class="bg-blue-100 text-xs rounded py-1">10K</button>
            <button wire:click="addCash(50000)" class="bg-blue-100 text-xs rounded py-1">50K</button>
            <button wire:click="addCash(100000)" class="bg-blue-100 text-xs rounded py-1">100K</button>
            <button wire:click="addCash({{ $total }})" class="bg-green-100 text-xs rounded py-1">Pas</button>
            <button wire:click="clearCash"
                class="bg-red-100 hover:bg-red-200 text-red-700 text-xs font-semibold px-3 py-1 rounded">C</button>
        </div>

        <!-- Payment Methods -->
        <div class="p-4 border-t border-gray-200">
            <h3 class="font-medium text-gray-700 mb-3">Metode Pembayaran</h3>
            <div class="grid grid-cols-3 gap-2 mb-4">
                <label for="cash"
                    class="payment-method-button border border-blue-500 bg-blue-50 py-2 rounded-lg text-center text-blue-600 font-medium">
                    <i class="fas fa-money-bill-wave text-blue-500 mr-1"></i>
                    Tunai
                </label>
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
                class="w-full py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold rounded-lg shadow-md transition duration-300 flex items-center justify-center"
                wire:click="processPayment">
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

    {{-- Button to cart --}}
    <button onclick="document.getElementById('cartSection').scrollIntoView({ behavior: 'smooth' })"
        class="fixed md:hidden bottom-4 right-4 bg-blue-600 text-white p-3 rounded shadow-lg hover:bg-blue-700 transition z-50">
        <i class="fas fa-cart-shopping"></i>
    </button>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Livewire.on('cart-updated', message => {
                Swal.fire({
                    position: 'top-end',
                    toast: true,
                    icon: 'success',
                    // title: '{{ session('success') }}',
                    text: message.message,
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                })
            });

            Livewire.on('cart-empty', message => {
                Swal.fire({
                    position: 'top-end',
                    toast: true,
                    icon: 'success',
                    // title: '{{ session('success') }}',
                    text: message.message,
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                })
            });

            Livewire.on('payment-failed', message => {
                console.log(message);
                Swal.fire({
                    position: 'top-end',
                    toast: true,
                    icon: 'error',
                    // title: '{{ session('success') }}',
                    text: message.message,
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                })
            });
        });
    </script>
</div>
