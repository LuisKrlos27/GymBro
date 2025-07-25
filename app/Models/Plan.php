<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $table = 'planes';

    public $timestamps = false;

    protected $fillable = ['nombre', 'duracion_dias', 'precio'];
}
