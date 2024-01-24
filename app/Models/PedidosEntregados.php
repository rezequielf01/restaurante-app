<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidosEntregados extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        // 'telefono',
        'direccion',
        // 'pedido',
        // 'metodo_de_pago',
        // 'retiro',
        'total',
        ];

    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';

}
