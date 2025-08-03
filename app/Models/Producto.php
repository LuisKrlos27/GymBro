<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';

    public $timestamps = false;

    protected $fillable = ['nombre', 'precio', 'cantidad','fecha_pago'];

    public function detallesVentas()
    {
        return $this->hasMany(Detalle_Venta::class, 'producto_id');
    }
}
