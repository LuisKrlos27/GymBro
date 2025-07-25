<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    protected $table = 'notificaciones';

    public $timestamps = false;

    protected $fillable = ['cliente_id', 'mensaje', 'leido', 'fecha_creacion'];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
