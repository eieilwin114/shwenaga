<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $fillable = [
        'name', 
        'description', 
        'price', 
        'category_id',
        'order_id',
        'qty',
    ];


    // protected $casts = [
    //     'id'         => 'integer',
    //     'quantity'   => 'float',
    //     'unit_price' => 'float',
    // ];

    // protected $appends = [
    //     'subtotal',
    // ];


    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    // public function getSubtotalAttribute()
    // {
    //     return $this->quantity * $this->unit_price;
    // }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
