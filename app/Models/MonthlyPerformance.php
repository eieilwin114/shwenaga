<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyPerformance extends Model
{
    use HasFactory;
    protected $fillable = [
        'month',
        'shop_id',
        'employee_id',
        'mark1',
        'mark2',
        'mark3',
        'mark4',
        'mark5',
        'total_mark',
        'total',
        'created_by',
        'update_by',
    ];
}
