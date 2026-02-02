<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'email',
        'telefono',
        'direccion',
        'empresa'
    ];

    // Relación con facturas
    public function facturas()
    {
        return $this->hasMany(Factura::class);
    }
}
