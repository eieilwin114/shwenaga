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
    protected $fillable = ['name', 'description','tag_id','image'];
    //protected $fillable = ['name', 'description', 'category_id'];
    // protected $appends = ['image'];
    // protected $hidden = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    
    // public function getImageAttribute($value)
    // {
    //     return $value;
    // }

    public function setImageAttribute($value)
    {
        // print_r();exit();
        $attribute_name = "image";
        if($value){
            $fileName = $value->getClientOriginalName();
        }
        $disk = "public";
        $destination_path = "img/products";
        $this->uploadFileToDisk($value, $attribute_name, $disk, $destination_path, $fileName = null);     
        // return asset('storage/img/products/' . $fileName);
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
    // public static function boot()
    // {
    //     parent::boot();
    //     static::deleting(function($obj) {
    //         if($obj){
    //             \Storage::disk('public')->delete($obj->image);
    //         }            
    //     });
    // }
}
