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


        $ingresosMensuales = PedidosEntregados::whereMonth('create_time', now()->month)->sum('total');;
        
        return view("admin.home", compact("usuariosRegistrados","productosRegistrados",
        "pedidosPendientes","pedidosEntregados","ingresosMensuales"));
    }
}
