<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mesas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nro_mesa',
        'capacidad',
    ];

    public function productos()
    {
        return $this->belongsToMany(Productos::class, 'mesas_productos')->withPivot('producto_cantidad');
    }
}
