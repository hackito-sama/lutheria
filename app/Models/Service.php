<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'owner_id',       // cliente dueño del instrumento
        'responsable', // trabajador que recibe
        'name',
        'description',
        'status',
        'price',
    ];

    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }
}
