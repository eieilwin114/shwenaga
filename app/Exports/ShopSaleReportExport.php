<?php

namespace App\Exports;

use App\Models\OrderItem;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ShopSaleReportExport implements FromCollection,WithHeadings, WithMapping, ShouldAutoSize

{
    function __construct($shop_sale_reports){
        $this->shop_sale_reports = $shop_sale_reports;
    }

    public function headings(): array
    {
        $headings = [
            'Date',
            'Name',
            'Quantity',
            'Shop',
            'Region'
        ];

        return $headings;

    }

    public function map($shop_sale_report): array
    {
        $shop_sale_reports = [
           date('d-m-y',strtotime($shop_sale_report->date)),
           $shop_sale_report->name,
           $shop_sale_report->qty,
           $shop_sale_report->shop_name,
           $shop_sale_report->division,
        ];

        return $shop_sale_reports;
    }


    public function collection()
    {
        return $this->shop_sale_reports;
    }
}
