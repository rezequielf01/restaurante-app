<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidosUsuario extends Model
{
    use HasFactory;

    protected $fillable = [
        'nro_pedido',
        'direccion',
        'pedido',
        'metodo_de_pago',
        'envio',
        'total',
        ];

}
