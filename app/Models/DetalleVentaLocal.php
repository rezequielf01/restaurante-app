<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\VentasLocal;

class DetalleVentaLocal extends Model
{
    use HasFactory;

    protected $fillable = [
        'mesa_nro',
        'venta_id',
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
        public function ventaLocal()
        {
            return $this->belongsTo(VentasLocal::class, 'venta_id', 'id');
        }

}
