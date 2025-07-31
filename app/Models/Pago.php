<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $table = "pagos";
    protected $fillable = [
        'cliente_id',
        'plan_id',
        'fecha_pago',
        'fecha_vencimiento',
        'hora_pago',
        'valor_total',
        'valor_pagado',
        'cambio',
        'estado',
    ];

    // Relación con Cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    // Relación con Plan
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
