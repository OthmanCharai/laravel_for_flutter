<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;
    protected $fillable = [
        "color"
    ];
    public function products(){
        return $this->belongsToMany(Product::class)->withTimestamps();
    }
    public function carts(){
        return $this->belongsToMany(Carts::class)->withTimestamps();
    }

}
