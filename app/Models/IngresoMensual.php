<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngresoMensual extends Model
{
    use HasFactory;

    protected $fillable = [
        'año',
        'mes',
        'ingreso_total',
        ];
}
