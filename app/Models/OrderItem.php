<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'pedido_id',
        'producto_id',
        'nombre',
        'cantidad',
        'precio',
        // 'telefono',
        // 'direccion',
        // 'pedido',
        // 'metodo_de_pago',
        // 'retiro',
        ];

}
