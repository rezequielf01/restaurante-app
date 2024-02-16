<?php

namespace App\Http\Controllers;

use App\Models\DetalleVentaLocal;
use App\Models\VentasLocal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminVentasLocalController extends Controller
{
    public function show(){

        $detalle_ventas = VentasLocal::join('detalle_venta_locals', 'ventas_locals.id', '=', 'detalle_venta_locals.venta_id')
        ->select('ventas_locals.*', 'detalle_venta_locals.*')
        ->get();

        return view("admin.ventas",compact("detalle_ventas"));
    }


}
