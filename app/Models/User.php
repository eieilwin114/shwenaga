<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


use Backpack\CRUD\app\Models\Traits\CrudTrait; // <------------------------------- this one
use Spatie\Permission\Traits\HasRoles;// <---------------------- and this one

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    use CrudTrait; // <----- this
    use HasRoles; // <------ and this



    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     * 
     * 
     */
    protected $table = 'users';
    protected $primaryKey = 'id';
    public $timestamps = true;
    
    protected $fillable = [
        'name',
        'email',
        'mobile',
        'password',
        'shop_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function shop()
    {
        return $this->belongsTo('\App\Models\Shop', 'shop_id');
    }
}
