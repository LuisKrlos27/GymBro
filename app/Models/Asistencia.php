<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    protected $table = 'asistencias';

    public $timestamps = false;

    protected $fillable = ['cliente_id', 'fecha_hora'];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
