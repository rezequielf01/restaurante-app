<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'imagen',
        'stock',
        'categoria_id',
    ];

    public function categoria() {
        return $this->belongsTo(Categorias::class, 'categoria_id');
    }

    public function mesas()
    {
        return $this->belongsToMany(Mesas::class, 'mesas_productos', 'productos_id', 'mesas_id');
    }

}
