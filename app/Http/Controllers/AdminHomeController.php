<?php

namespace App\Http\Controllers;

use App\Models\Pedidos;
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
        return view("admin.home", compact("usuariosRegistrados","productosRegistrados","pedidosPendientes"));
    }
}
