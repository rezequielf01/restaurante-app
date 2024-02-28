<?php

namespace App\Http\Controllers;

use App\Models\DetalleVentaLocal;
use App\Models\VentasLocal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminVentasLocalController extends Controller
{
    public function show(){

        $ventas = VentasLocal::with('DetallesVenta')
        ->orderBy('created_at', 'desc')
        ->get();

        return view("admin.ventas",compact("ventas"));
    }


}
