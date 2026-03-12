<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'images',
        'specifications',
        'flg_index'
    ];

    /**
     * Acceso directo a las imágenes como array
     */
    public function getImagenesAttribute($value)
    {
        return $value ? json_decode($value, true) : [];
    }

    /**
     * Guardar imágenes como JSON
     */
    public function setImagenesAttribute($value)
    {
        $this->attributes['images'] = json_encode($value);
    }
    
}
