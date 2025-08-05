<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = 'ventas';

    protected $fillable = ['cliente_id', 'fecha', 'total', 'valor_pagado', 'cambio'];


    public function detalles()
    {
        return $this->hasMany(DetalleVenta::class);
    }
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
    public function detalleVentas()
{
    return $this->hasMany(DetalleVenta::class, 'venta_id');
}
}
