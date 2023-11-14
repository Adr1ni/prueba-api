<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre_empresa',
        'ruc',
        'direccion',
        'telefono',
        'correo_electronico',
        'contacto',
        'fecha_registro',
        'activa',
    ];

    protected $casts = [
        'fecha_registro' => 'date',
        'activa' => 'boolean',
    ];

    public function facturas()
    {
        return $this->hasMany(Factura::class);
    }

}
