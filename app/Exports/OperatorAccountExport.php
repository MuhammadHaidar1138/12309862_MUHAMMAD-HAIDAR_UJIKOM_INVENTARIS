<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OperatorAccountExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return User::where('role', 'staff')
            ->select('name', 'email', 'created_at')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Created At',
        ];
    }
}
