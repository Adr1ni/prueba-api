<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $fillable = [
        'descripcion',
        'stock',
        'precio_unitario',
        'categoria',
    ];

    protected $casts = [
        'stock' => 'decimal:2',
        'precio_unitario' => 'decimal:2',
    ];

    public function detallesFactura()
    {
        return $this->hasMany(DetalleFactura::class);
    }
}
