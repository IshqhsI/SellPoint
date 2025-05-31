<div class="p-6 my-4 bg-white rounded-2xl shadow-xl space-y-6">

    {{-- Informasi Transaksi --}}
    <div class="flex justify-between items-center">
        <div>
            <p class="text-sm text-gray-500">Date</p>
            <p class="text-base font-medium text-gray-800">
                {{ $transaction->created_at->format('d M Y, H:i') }}
            </p>
        </div>
        <div>
            <p class="text-sm text-gray-500">Payment Method</p>
            <p class="text-base font-medium text-gray-800">
                {{ ucfirst($transaction->payment_method) }}
            </p>
        </div>
    </div>

    {{-- Daftar Produk --}}
    <div>
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Products</h3>
        <div class="space-y-4">
            @php
                $products = json_decode($transaction->products, true);
                $total = 0;
            @endphp

            @foreach ($products as $product)
                @php
                    $subtotal = $product['price'] * $product['quantity'];
                    $total += $subtotal;
                @endphp

                <div class="flex items-center bg-gray-50 border border-gray-200 rounded-lg p-4">
                    {{-- Gambar Produk --}}
                    @if (!empty($product['image']))
                        <img src="{{ asset('storage/' . $product['image']) }}" alt="Product Image"
                             class="h-14 w-14 rounded-md object-cover mr-4 shadow">
                    @else
                        <div class="h-14 w-14 rounded-md bg-gray-200 flex items-center justify-center text-gray-400 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 4a1 1 0 011-1h2.586A1 1 0 018 3.586l1.707 1.707A1 1 0 0010.414 6H20a1 1 0 011 1v10a1 1 0 01-1 1h-5m-6 0h6m-6 0a2 2 0 01-2-2v-5a2 2 0 012-2h.586a1 1 0 00.707-.293L13 7.414A1 1 0 0113.586 7H18" />
                            </svg>
                        </div>
                    @endif

                    {{-- Detail Produk --}}
                    <div class="flex-1">
                        <p class="text-base font-medium text-gray-900">{{ $product['name'] }}</p>
                        <p class="text-sm text-gray-500">
                            Price: Rp{{ number_format($product['price'], 0, ',', '.') }}
                        </p>
                    </div>

                    {{-- Quantity & Subtotal --}}
                    <div class="text-right">
                        <p class="text-sm text-gray-700">x{{ $product['quantity'] }}</p>
                        <p class="text-sm font-semibold text-gray-900">
                            Rp{{ number_format($subtotal, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Button print & Subtotal --}}
    <div class="flex justify-between border-t my-4 py-4">
        <button onclick="printSection('print-view')" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg shadow hover:bg-blue-700 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 9V2h12v7M6 18H4a2 2 0 01-2-2V9a2 2 0 012-2h16a2 2 0 012 2v7a2 2 0 01-2 2h-2m-4 0h-4v4h4v-4z" />
            </svg>
            Print
        </button>

        {{-- Total Pembayaran --}}
        <div class="text-right">
            <p class="text-lg font-bold text-gray-900">Total: Rp{{ number_format($total, 0, ',', '.') }}</p>
        </div>
    </div>

    {{-- Print view --}}
    <div class="hidden" id="print-view">
        @include('livewire.invoice.print')
    </div>


    <script>
        function printSection(sectionId) {
            const printContent = document.getElementById(sectionId).innerHTML;
            const originalContent = document.body.innerHTML;

            document.body.innerHTML = printContent;
            window.print();
            document.body.innerHTML = originalContent;
            location.reload();
        }
    </script>
</div>
