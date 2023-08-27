<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Township extends Model
{
    use HasFactory;
    protected $table = 'townships';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'township',
        'division_id',
        'created_by',
        'updated_by'
    ]; 

    function division(){
        return $this->belongsTo('\App\Models\Division', 'division_id','id');
    }
}
