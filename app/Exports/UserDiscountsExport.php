<?php

namespace App\Exports;

use App\Models\DiscountCheck;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UserDiscountsExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DiscountCheck::with(['discount.vendor', 'discount', 'user'])
            ->where('user_id', $this->userId)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            __('message.User'),
            __('message.Vendor'),
            __('message.Discount Title'),
            __('message.Comment'),
            __('message.Price'),
            __('message.Final Price'),
            __('message.Discount Value'),
            __('message.Status'),
            __('message.Date'),
        ];
    }

    /**
     * @param DiscountCheck $discountCheck
     * @return array
     */
    public function map($discountCheck): array
    {
        return [
            $discountCheck->user->name ?? '-',
            $discountCheck->discount->vendor->name ?? '-',
            $discountCheck->discount->title ?? '-',
            $discountCheck->comment ?? '-',
            $discountCheck->price ? number_format($discountCheck->price, 2) : '-',
            $discountCheck->final_price ? number_format($discountCheck->final_price, 2) : '-',
            $discountCheck->discount_value ? number_format($discountCheck->discount_value, 2) : '-',
            $this->getStatusText($discountCheck->status),
            $discountCheck->created_at ? $discountCheck->created_at->format('Y-m-d H:i:s') : '-',
        ];
    }

    /**
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1 => ['font' => ['bold' => true]],
            
            // Set auto width for all columns
            'A:I' => ['alignment' => ['horizontal' => 'center']],
        ];
    }

    /**
     * Get status text based on status value
     */
    private function getStatusText($status)
    {
        switch ($status) {
            case 'pending':
                return __('message.Pending');
            case 'accepted':
                return __('message.Accepted');
            case 'cancelled':
                return __('message.Canceled');
            default:
                return $status;
        }
    }
}
