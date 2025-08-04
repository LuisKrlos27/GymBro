<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = 'ventas';

    public $timestamps = false;

    protected $fillable = ['cliente_id', 'fecha', 'total', 'detalles_json'];

    protected $casts = [
        'detalles_json' => 'array',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
