<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;



class Attendance extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $fillable = [
        'check_in_at',
        'check_in_position',
        'check_out_at',
        'check_out_position',
        'employee_id',
    ];


    protected $casts = [
        // 'check_in_at' => 'date:h:m a',
        // 'check_out_at' => 'date:h:m a',
        'check_in_position' => 'array',
        'check_out_position' => 'array',
        'created_at' => 'date:d F, Y',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class,'employee_id','id');
    }
}
