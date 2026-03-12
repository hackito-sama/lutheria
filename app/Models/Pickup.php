<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pickup extends Model
{
    protected $fillable = [
        'name',
        'value',
        'product_type',
        'additional'
    ];
}
