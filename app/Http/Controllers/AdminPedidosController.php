<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pedidos;

class AdminPedidosController extends Controller
{

    public function show(){
        $pedidos = db::select('SELECT * FROM pedidos');
        $pedidos_clientes = DB::table('users')
        ->join('pedidos', 'pedidos.cliente_id', '=', 'users.id')
        ->select('users.name', 'pedidos.direccion', 'users.telefono','pedidos.id','pedidos.envio','pedidos.total','pedidos.create_time')
        ->get();

        $pedidos_entregados = db::select("SELECT * FROM pedidos_entregados");
        $pedidos_clientes_entregado = DB::table('users')
        ->join('pedidos_entregados', 'pedidos_entregados.cliente_id', '=', 'users.id')
        ->select('users.name', 'pedidos_entregados.direccion', 'users.telefono','pedidos_entregados.id','pedidos_entregados.envio','pedidos_entregados.total','pedidos_entregados.create_time')
        ->get();

        return view("admin.pedidos", compact("pedidos","pedidos_clientes","pedidos_clientes_entregado"));
    }

    public function orderMoved($id){

        $moverPedido = DB::insert('INSERT INTO pedidos_entregados SELECT * FROM pedidos WHERE id = ?', [$id]);
        $detallesPedido = DB::insert('INSERT INTO order_items_delivereds SELECT * FROM order_items WHERE pedido_id = ?', [$id]);
        if($moverPedido && $detallesPedido){
            
                    DB::commit();
                    Pedidos::destroy($id);

        }
        else{
            db::rollBack();
        }
        


        return back()->withSuccess('!Pedido entregado!');
    }

    // public function ordersDelivered(){
    //     $pedidos_entregados = db::select("SELECT * FROM pedidos_entregados");
    //     $pedidos_clientes = DB::table('users')
    //     ->join('pedidos_entregados', 'pedidos_entregados.cliente_id', '=', 'users.id')
    //     ->select('users.name', 'pedidos_entregados.direccion', 'users.telefono','pedidos_entregados.id','pedidos_entregados.envio','pedidos_entregados.total','pedidos_entregados.create_time')
    //     ->get();

    //     return view("admin.pedidos-entregados", compact("pedidos_entregados","pedidos_clientes"));
    // }

    public function destroy($id){

        Pedidos::destroy($id);

        return back()->withSuccess('!Pedido cancelado!');

    }
}

?>