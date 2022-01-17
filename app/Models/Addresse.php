<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addresse extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "city",
        "region",
        "details",
        "notes",
        "latitude",
        "longitude",
        "user_id",
    ];

}
