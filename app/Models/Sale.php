<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $table = 'sales';

    /**
     * Los atributos que son asignables en masa
     */
    protected $fillable = [
        'user_id',
        'products',
        'total',
    ];

    /**
     * Casts para atributos especiales
     */
    protected $casts = [
        'products' => 'array', // convierte el JSON a array automáticamente
        'total' => 'decimal:2',
    ];

    /**
     * Relación con User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Accesor opcional para calcular el total automáticamente
     */
    public function calculateTotal(): float
    {
        return collect($this->products)->sum(function ($item) {
            return $item['precio'] * $item['cantidad'];
        });
    }
}
