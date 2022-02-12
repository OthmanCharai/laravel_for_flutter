<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'quantity',
        'status',
        'image',
        'user_id',
        'price',
        "isPopulaire"
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }
  /*   public function buyer()
    {
        return $this->belongsToMany(User::class);
    } */
    public function favorites(){
        return $this->belongsToMany(User::class,'favorites','product_id','user_id')->withTimestamps();
    }
    public function images(){
        return $this->hasMany(Image::class);
    }
    public function colors(){
        return $this->belongsToMany(Color::class)->withTimestamps();
    }
    public function carts(){
        return $this->belongsToMany(User::class,'carts','product_id','user_id')->withTimestamps()->withPivot('quantity');
    }
}
