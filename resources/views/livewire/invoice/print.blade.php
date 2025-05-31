<div class="receipt">
    <h2>TK. ELIN</h2>
    <p class="address">Jl. Pendreh, Muara Teweh</p>
    <p class="date">{{ $transaction->created_at->format('d M Y H:i:s') }}</p>
    <div class="line"></div>

    <table class="items">
        @foreach (json_decode($transaction->products) as $item)
        <tr>
            <td class="name">{{ $item->name }}</td>
            <td class="qty">{{ $item->quantity }}x</td>
            <td class="price">Rp{{ number_format($item->price, 0, ',', '.') }}</td>
        </tr>
        @endforeach
    </table>

    <div class="line"></div>
    <p class="total">Total: Rp{{ number_format($transaction->total, 0, ',', '.') }}</p>
    <div class="line"></div>
    <p class="footer">Terima kasih telah berbelanja!</p>
</div>
