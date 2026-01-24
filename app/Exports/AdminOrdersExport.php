<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class AdminOrdersExport implements FromQuery, WithHeadings, WithMapping, WithEvents
{
    protected $from;
    protected $to;

    public function __construct($from = null, $to = null)
    {
        $this->from = $from;
        $this->to = $to;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $highestRow = $sheet->getHighestRow();
                $lastRow = $highestRow + 2;
                $sheet->mergeCells("A{$lastRow}:E{$lastRow}");
                $sheet->setCellValue("A{$lastRow}", '© ' . date('Y') . ' Nokenz Game Store — Official Report');
                $sheet->getStyle("A{$lastRow}")->getFont()->setItalic(true)->setSize(10);
                $sheet->getStyle("A{$lastRow}")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            },
        ];
    }

    public function query()
    {
        $q = Order::query()->with('user');

        if ($this->from) {
            $q->whereDate('tanggal_order', '>=', $this->from);
        }
        if ($this->to) {
            $q->whereDate('tanggal_order', '<=', $this->to);
        }

        return $q->select('id','user_id','total_harga','status','tanggal_order');
    }

    public function headings(): array
    {
        return [
            'Order ID',
            'User',
            'Total (Rp)',
            'Status',
            'Tanggal',
        ];
    }

    public function map($order): array
    {
        return [
            $order->id,
            $order->user?->name ?? '—',
            number_format($order->total_harga, 0, ',', '.'),
            $order->status,
            $order->tanggal_order?->format('Y-m-d') ?? '',
        ];
    }
}
