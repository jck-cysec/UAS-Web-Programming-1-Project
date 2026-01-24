<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Exports\UserOrderExport;

class OrderExportController extends Controller
{
    public function pdf(Order $order)
    {
        $order->load('orderItems.game', 'user');

        $pdf = app('dompdf.wrapper')->loadView('exports.user-invoice', compact('order'))
            ->setPaper('a4', 'portrait');

        return $pdf->download("invoice-{$order->id}.pdf");
    }

    public function excel(Order $order)
    {
        return app('excel')->download(new UserOrderExport($order), "invoice-{$order->id}.xlsx");
    }
}
