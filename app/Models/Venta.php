<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = 'ventas';

    public $timestamps = false;

    protected $fillable = ['cliente_id', 'fecha', 'total'];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function detalles()
    {
        return $this->hasMany(Detalle_Venta::class, 'venta_id');
    }
}
