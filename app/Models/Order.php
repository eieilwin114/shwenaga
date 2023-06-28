<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $fillable = [
        'sale_person_id',
        'shop_owner_id',
        'status',
    ];

    protected $appends = [
        'total_qty',
        'order_summary',
    ];


    protected $casts = [
        'created_at' => 'date:d F, Y',
    ];


    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    
    public function getTotalQtyAttribute()
    {
        return $this->items()->sum('qty');
    }

    public function getOrderSummaryAttribute()
    {
        $string = "";
        foreach($this->items as $item){
            $string .= $item->name . " x " . $item->qty.", ";
        }
        return $string;
    }

}
