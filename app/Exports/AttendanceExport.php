<?php

namespace App\Exports;

use App\Models\Attendance;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AttendanceExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    function __construct($attendances){
        $this->attendances = $attendances;
    }

    public function headings(): array
    {
        $headings = [
            'Name',
            'Date',
            'Region',
            'Shop',
            'Check In Time',
            'Check In Position',
            'Check Out Time',
            'Check Out Position',
            'Note'
        ];

        return $headings;

    }

    public function map($attendance): array
    {
        $attendances = [
            $attendance->user_name,
            date('d-m-y',strtotime($attendance->created_at)),
            $attendance->division,
            $attendance->shop_name,
            date('h:i A',strtotime($attendance->check_in_at)),
            json_encode($attendance->check_in_position),
            date('h:i A',strtotime($attendance->check_out_at)),
            json_encode($attendance->check_out_position),
            $attendance->notes,
        ];

        return $attendances;
    }


    public function collection()
    {
        return $this->attendances;
    }
}
