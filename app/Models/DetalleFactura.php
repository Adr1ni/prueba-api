<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleFactura extends Model
{
    use HasFactory;

    protected $fillable = [
        'factura_id',
        'producto_id',
        'cantidad',
        'igv',
        'descuento',
        'subtotal',
        'total',
    ];

    public static function boot()
    {
        parent::boot();

        self::saving(function ($detalleFactura) {
            $producto = Producto::find($detalleFactura->producto_id);

            if ($producto) {
                $detalleFactura->subtotal = $producto->precio_unitario * $detalleFactura->cantidad;

                $detalleFactura->igv = $detalleFactura->subtotal * 0.18;
                $detalleFactura->total = $detalleFactura->subtotal - $detalleFactura->descuento + $detalleFactura->igv;
                
                $producto->stock -= $detalleFactura->cantidad; 
                $producto->save();
            }
        });
    }

    public function factura()
    {
        return $this->belongsTo(Factura::class);
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}

