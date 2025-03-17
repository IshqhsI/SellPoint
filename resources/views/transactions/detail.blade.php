<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembelian</title>
    <style>
        /* Ukuran kertas thermal (sesuaikan dengan printer, misal 58mm atau 80mm) */
        @page {
            size: 46mm auto;
            margin: 0;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
            width: 46mm;
        }

        .receipt {
            text-align: center;
            margin: auto;
        }

        .receipt h2 {
            margin: 4px 0;
            font-size: 14px;
        }

        .receipt p{
            font-size: 12px;
        }

        .receipt .line {
            border-top: 1px dashed black;
            margin: 5px 0;
        }

        .items {
            width: 100%;
        }

        .items td {
            font-size: 10px;
        }

        .total {
            font-size: 10px;
            font-weight: bold;
            text-align: right;
        }

        .footer {
            margin-top: 10px;
            text-align: center;
            font-size: 8px;
        }

        /* Sembunyikan tombol saat dicetak */
        @media print {
            .receipt a {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="receipt">
        <h2>TK. ELIN</h2>
        <p class="address"> Jl. Pendreh, Muara Teweh </p>
        <p>{{ $transaction->created_at->format('d M Y H:i:s') }}</p>
        <div class="line"></div>

        <table class="items">
            @foreach (json_decode($transaction->products) as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->quantity }}x</td>
                <td>Rp{{ number_format($item->price, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </table>

        <div class="line"></div>
        <p class="total">Total: Rp{{ number_format($transaction->total, 0, ',', '.') }}</p>

        <div class="line"></div>
        <p class="footer">Terima kasih telah berbelanja!</p>

        <a href="{{ route('home') }}"> Back to Home </a>
    </div>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>
