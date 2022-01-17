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
        'seller_id',
    ];
    public function seller(){
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    public function buyer()
    {
        return $this->belongsToMany(User::class);
    }
    public function favorite(){
        return $this->hasMany(Favorite::class);
    }
    public function images(){
        return $this->hasMany(Image::class);
    }
}
