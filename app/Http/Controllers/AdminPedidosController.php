<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pedidos;

class AdminPedidosController extends Controller
{
    public function show(){
        $pedidos = db::select('SELECT * FROM pedidos');
        return view("admin.pedidos", compact("pedidos"));
    }

    public function destroy($id){

        $pedidos = Pedidos::where("id",$id)->first();
        $pedidos->delete();

        return back()->withSuccess('!Pedido entregado!');

    }
}
