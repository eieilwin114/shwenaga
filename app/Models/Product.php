<?php

namespace App\Models;

use App\Enums\ProductStatus;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use CrudTrait;
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'products';
    protected $primaryKey = 'id';
    public $timestamps = true;
    // protected $guarded = ['id'];
    protected $fillable = ['name', 'description', 'price', 'tag_id'];
    //protected $fillable = ['name', 'description', 'category_id'];
    protected $appends = ['image'];
    // protected $hidden = [];]u

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public function getImageAttribute()
    {
        $rand = mt_rand(1,11);
        $rand = $rand<10?"0{$rand}":$rand;
        return url("assets/img/products/{$rand}.jpg");
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function tag()
    {
        return $this->belongsTo('\App\Models\Tag', 'tag_id');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */
    public function scopeSearch($query, $search)
    {
        return $query
                    ->where('name', 'LIKE', "%$search%")
                    ->orWhere('description', 'LIKE', "%$search%");
    }
    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
