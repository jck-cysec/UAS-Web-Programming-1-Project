<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Exports\AdminOrdersExport;

class OrderExportController extends Controller
{
    public function pdf(Request $request)
    {
        $query = Order::with('user');

        if ($request->filled('from')) {
            $query->whereDate('tanggal_order', '>=', $request->input('from'));
        }
        if ($request->filled('to')) {
            $query->whereDate('tanggal_order', '<=', $request->input('to'));
        }

        $orders = $query->orderBy('tanggal_order', 'desc')->get();
        $summary = [
            'count' => $orders->count(),
            'total' => $orders->sum('total_harga'),
        ];

        $pdf = app('dompdf.wrapper')->loadView('exports.admin-orders', compact('orders', 'summary'))
            ->setPaper('a4', 'landscape');

        $fileName = 'orders_report_' . now()->format('Ymd_His') . '.pdf';
        return $pdf->download($fileName);
    }

    public function excel(Request $request)
    {
        $from = $request->input('from');
        $to = $request->input('to');

        return app('excel')->download(new AdminOrdersExport($from, $to), 'orders_report.xlsx');
    }
}
