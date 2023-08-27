<?php

namespace App\Exports;

use App\Models\OrderItem;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SaleReportExport implements FromCollection,WithHeadings, WithMapping, ShouldAutoSize
{
    function __construct($sale_reports){
        $this->sale_reports = $sale_reports;
    }

    public function headings(): array
    {
        $headings = [
            'Date',
            'Name',
            'Region',
            'Shop',
            'Quantity',
            'Sale Person Name',
            'Mobile',

        ];

        return $headings;

    }

    public function map($sale_report): array
    {
        $sale_reports = [
           date('d-m-y',strtotime($sale_report->date)),
           $sale_report->name,
           $sale_report->division,
           $sale_report->shop_name,
           $sale_report->qty,
           $sale_report->sale_person,
           $sale_report->mobile,
        ];

        return $sale_reports;
    }


    public function collection()
    {
        return $this->sale_reports;
    }
}
