<div class="p-6 bg-white rounded-lg shadow-md">

    {{-- Informasi Transaksi --}}
    <div class="mb-6">
        <p class="text-gray-700"><strong>Transaction ID:</strong> {{ $transaction->id }}</p>
        <p class="text-gray-700"><strong>Date:</strong> {{ $transaction->created_at->format('d M Y, H:i') }}</p>
        <p class="text-gray-700"><strong>Payment Method:</strong> {{ $transaction->payment_method }}</p>
    </div>

    {{-- Daftar Produk --}}
    <div class="mb-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-2">Products</h3>
        <div class="border rounded-lg p-4 bg-gray-50">
            @php
                $products = json_decode($transaction->products, true);
                $total = 0;
            @endphp

            @foreach ($products as $product)
                @php
                    $subtotal = $product['price'] * $product['quantity'];
                    $total += $subtotal;
                @endphp
                <div class="flex items-center border-b last:border-none py-3">
                    {{-- Gambar Produk (Jika Ada) --}}
                    @if (!empty($product['image']))
                        <img src="{{ asset('storage/' . $product['image']) }}" alt="Product Image"
                            class="h-12 w-12 rounded-md object-cover mr-4">
                    @endif

                    {{-- Detail Produk --}}
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-900">{{ $product['name'] }}</p>
                        <p class="text-xs text-gray-500">Price: Rp{{ number_format($product['price'], 0, ',', '.') }}
                        </p>
                    </div>

                    {{-- Quantity --}}
                    <p class="text-sm mx-2 font-medium text-gray-900">x{{ $product['quantity'] }}</p>

                    {{-- Subtotal --}}
                    <p class="text-sm text-gray-900 ml-auto">Rp{{ number_format($subtotal, 0, ',', '.') }}</p>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Total Pembayaran --}}
    <div class="border-t pt-4 text-right">
        <p class="text-lg font-semibold text-gray-900">Total: Rp{{ number_format($total, 0, ',', '.') }}</p>
    </div>
</div>
