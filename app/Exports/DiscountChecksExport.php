<?php

namespace App\Exports;

use App\Models\DiscountCheck;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class DiscountChecksExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return DiscountCheck::all();
    }

    public function map($check): array
    {
        return [
            $check->user->name ?? '',
            $check->user->email ?? '',
            $check->user->phone ?? '',
            $check->comment ?? '',
            $check->price ?? '',
            $check->final_price ?? '',
            $check->status ?? '',
            $check->discount->vendor->name ?? '',
            $check->discount->title ?? '',
            $check->created_at ?? '',
        ];
    }

    public function headings(): array
    {
        return [
            'User Name',
            'Email',
            'Phone',
            'Comment',
            'Price',
            'Final Price',
            'Status',
            'Created At',
            'Vendor Name',
            'Discount Title',
        ];
    }
}
