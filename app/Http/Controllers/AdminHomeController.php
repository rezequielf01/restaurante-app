<?php

namespace App\Http\Controllers;

use App\Models\Pedidos;
use App\Models\PedidosEntregados;
use App\Models\User;
use App\Models\Productos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminHomeController extends Controller
{
    public function index(){
        $usuariosRegistrados = User::count();
        $productosRegistrados = Productos::count();
        $pedidosPendientes = Pedidos::count();
        $pedidosEntregados = PedidosEntregados::count();
        $comidasSQL = DB::select("SELECT * FROM productos WHERE categoria = 'hamburgesa' OR categoria = 'pizza'");
        $comidas = count($comidasSQL);
        $bebidasSQL = DB::select("SELECT * FROM productos WHERE categoria = 'bebida'");
        $bebidas = count($bebidasSQL);
        $ingresos = db::select("SELECT total FROM pedidos_entregados");
        return view("admin.home", compact("usuariosRegistrados","productosRegistrados",
        "pedidosPendientes","pedidosEntregados","comidas","bebidas","ingresos"));
    }
}
