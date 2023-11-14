<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;
    protected $fillable = [
        'empresa_id',
        'fecha_emision',
        'fecha_vencimiento',
        'moneda',
        'condicion_pago',
        'observacion',
    ];

    protected $casts = [
        'fecha_emision' => 'date',
        'fecha_vencimiento' => 'date',
    ];

    public function detalles()
    {
        return $this->hasMany(DetalleFactura::class);
    }
}
