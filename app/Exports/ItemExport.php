<?php

namespace App\Exports;

use App\Models\Item;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ItemExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Item::with('category')->get()->map(function ($item) {
            return [
                'category' => $item->category->category_name ?? '-',
                'name' => $item->item_name,
                'total_stock' => $item->total_stock,
                'total_repaired' => $item->total_repaired,
                'total_borrowed' => $item->total_borrowed,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Category',
            'Name',
            'Total',
            'Repair',
            'Lending',
        ];
    }
}