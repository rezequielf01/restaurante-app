<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MesasProductos extends Model
{
    use HasFactory;

    protected $fillable = [
        'mesas_id',
        'productos_id',
        'producto_cantidad',
    ];

    public function producto()
    {
        return $this->belongsTo(Productos::class, 'productos_id');
    }

    public function ventas()
    {
        return $this->hasMany(VentasLocal::class);
    }

}
