<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DetalleVentaLocal;

class VentasLocal extends Model
{
    use HasFactory;

    protected $fillable = [
        'cajero',
        'cliente',
        'forma_de_pago',
        'total',
    ];

    public function detallesVentas()
    {
        
        return $this->hasMany(DetalleVentaLocal::class, 'venta_id', 'id');
    }

    
}
