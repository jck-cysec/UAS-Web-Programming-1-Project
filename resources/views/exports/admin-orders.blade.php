<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Orders Report</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; color: #111; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 8px; border: 1px solid #ddd; }
        th { background: #f4f4f4; }
        .right { text-align: right; }
    </style>
</head>
<body style="position:relative;">
    <!-- Watermark -->
    <div style="position:fixed; top:45%; left:50%; transform:translate(-50%,-50%) rotate(-30deg); font-size:56px; color:#000; opacity:0.05; z-index:0; pointer-events:none; white-space:nowrap;">Nokenz Game Store</div>

    <h1 style="position:relative; z-index:1;">Orders Report</h1>

    <p style="position:relative; z-index:1;"><strong>Total Orders:</strong> {{ $summary['count'] }}</p>
    <p style="position:relative; z-index:1;"><strong>Total Revenue:</strong> Rp {{ number_format($summary['total'], 0, ',', '.') }}</p>

    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>User</th>
                <th class="right">Total (Rp)</th>
                <th>Status</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->user?->name ?? '—' }}</td>
                    <td class="right">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                    <td>{{ ucfirst($order->status) }}</td>
                    <td>{{ $order->tanggal_order?->format('Y-m-d') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Footer / Copyright -->
    <div style="position:relative; z-index:1; margin-top:1.5rem; text-align:center; font-size:10px; color:#666;">© {{ date('Y') }} Nokenz Game Store — Official Report</div>
</body>
</html>