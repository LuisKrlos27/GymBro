<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';

    public $timestamps = false;

    protected $fillable = ['nombre', 'cedula', 'celular', 'edad'];

    public function citas()
    {
        return $this->hasMany(Cita::class, 'cliente_id');
    }

    public function asistencias()
    {
        return $this->hasMany(Asistencia::class, 'cliente_id');
    }

    public function ventas()
    {
        return $this->hasMany(Venta::class, 'cliente_id');
    }

    public function notificaciones()
    {
        return $this->hasMany(Notificacion::class, 'cliente_id');
    }
}
