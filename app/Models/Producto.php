<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'stock',
        'sku',
        'imagen',
        'ficha_tecnica'    
        ];

    protected $casts = [
        'precio' => 'decimal:2',
        'stock' => 'integer'
    ];
}
