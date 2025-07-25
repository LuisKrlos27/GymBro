<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detalle_venta extends Model
{
    protected $table = 'detalles_ventas';

    public $timestamps = false;

    protected $fillable = ['venta_id', 'producto_id', 'cantidad', 'precio_unitario'];

    public function venta()
    {
        return $this->belongsTo(Venta::class);
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
