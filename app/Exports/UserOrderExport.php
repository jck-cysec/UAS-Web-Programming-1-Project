<?php

namespace App\Exports;

use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use App\Models\Order;

class UserOrderExport implements FromCollection, WithHeadings, WithMapping, WithEvents
{
    protected Order $order;

    public function __construct(Order $order)
    {
        $this->order = $order->load('orderItems.game', 'user');
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $highestRow = $sheet->getHighestRow();
                $lastRow = $highestRow + 2;
                $sheet->mergeCells("A{$lastRow}:D{$lastRow}");
                $sheet->setCellValue("A{$lastRow}", '© ' . date('Y') . ' Nokenz Game Store — Official Invoice');
                $sheet->getStyle("A{$lastRow}")->getFont()->setItalic(true)->setSize(10);
                $sheet->getStyle("A{$lastRow}")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            },
        ];
    }

    public function collection()
    {
        return collect($this->order->orderItems);
    }

    public function headings(): array
    {
        return [
            'Game',
            'Quantity',
            'Price (per)',
            'Subtotal',
        ];
    }

    public function map($item): array
    {
        return [
            $item->game?->nama_game ?? 'Unknown',
            $item->qty,
            number_format($item->harga, 0, ',', '.'),
            number_format($item->qty * $item->harga, 0, ',', '.'),
        ];
    }
}
