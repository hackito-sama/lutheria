<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $fillable = [
        'name',
        'value',
        'product_type',
        'images'
    ];

    protected $casts = ['images' => 'array'];
}
