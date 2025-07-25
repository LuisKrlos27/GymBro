<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table = 'empleados';

    public $timestamps = false;

    protected $fillable = ['nombre', 'cedula', 'edad', 'celular', 'rol_id'];

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol_id');
    }

    public function citas()
    {
        return $this->hasMany(Cita::class, 'empleado_id');
    }
}
