<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Invoice #{{ $order->id }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; color: #111; }
        .header { text-align: center; margin-bottom: 1.5rem; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 8px; border: 1px solid #ddd; }
        th { background: #f4f4f4; }
        .right { text-align: right; }
    </style>
</head>
<body style="position:relative;">
    <!-- Watermark -->
    <div style="position:fixed; top:45%; left:50%; transform:translate(-50%,-50%) rotate(-30deg); font-size:48px; color:#000; opacity:0.06; z-index:0; pointer-events:none; white-space:nowrap;">Nokenz Game Store</div>

    <div class="header" style="position:relative; z-index:1;">
        <h1>Invoice</h1>
        <p>Invoice #{{ $order->id }} — {{ $order->tanggal_order?->format('d M Y') ?? '' }}</p>
    </div>

    <p><strong>Customer:</strong> {{ $order->user->name ?? '—' }} ({{ $order->user->email ?? '—' }})</p>

    <table>
        <thead>
            <tr>
                <th>Game</th>
                <th>Qty</th>
                <th class="right">Price</th>
                <th class="right">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->orderItems as $item)
                <tr>
                    <td>{{ $item->game?->nama_game ?? 'Unknown' }}</td>
                    <td class="right">{{ $item->qty }}</td>
                    <td class="right">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                    <td class="right">Rp {{ number_format($item->qty * $item->harga, 0, ',', '.') }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3" class="right"><strong>Total</strong></td>
                <td class="right"><strong>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</strong></td>
            </tr>
        </tbody>
    </table>

    <p style="margin-top:1rem;">Status: {{ ucfirst($order->status) }}</p>

    <!-- Footer / Copyright -->
    <div style="position:relative; z-index:1; margin-top:1.5rem; text-align:center; font-size:10px; color:#666;">© {{ date('Y') }} Nokenz Game Store — Official Invoice</div>
</body>
</html>