<?php

namespace App\Models;



use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        "phone",
        "image",

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
    ];
    public function products(){
        return $this->hasMany(Product::class);
    }
    public function shopping(){
        return $this->belongsToMany(Product::class)->withTimestamps();
    }
    public function roles(){
        return $this->belongsToMany(Role::class);
    }
    public function address(){
        return $this->hasMany(Address::class);
    }
    public function userFavorite(){
        return $this->belongsToMany(Product::class,'favorites','user_id','product_id')->withTimestamps();
    }
    public function userCarts(){
        return $this->belongsToMany(Product::class,'carts','user_id','product_id')->withTimestamps()->withPivot('quantity');
    }
}
