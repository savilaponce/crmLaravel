<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'email',
        'telefono',
        'puesto',
        'salario',
        'fecha_contratacion'
    ];

    protected $casts = [
        'salario' => 'decimal:2',
        'fecha_contratacion' => 'date'
    ];
}
