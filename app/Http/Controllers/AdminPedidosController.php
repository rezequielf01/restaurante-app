<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pedidos;

class AdminPedidosController extends Controller
{

    public function show()
    {
        $pedidos = db::select('SELECT * FROM pedidos');
        $pedidos_clientes = DB::table('users')
            ->join('pedidos', 'pedidos.cliente_id', '=', 'users.id')
            ->select('users.name', 'pedidos.direccion', 'users.telefono', 'pedidos.id', 'pedidos.envio', 'pedidos.total', 'pedidos.create_time')
            ->get();

        $pedidos_entregados = db::select("SELECT * FROM pedidos_entregados");
        $pedidos_clientes_entregado = DB::table('users')
            ->join('pedidos_entregados', 'pedidos_entregados.cliente_id', '=', 'users.id')
            ->select('users.name', 'pedidos_entregados.direccion', 'users.telefono', 'pedidos_entregados.id', 'pedidos_entregados.envio', 'pedidos_entregados.total', 'pedidos_entregados.create_time')
            ->get();

        return view("admin.pedidos", compact("pedidos", "pedidos_clientes", "pedidos_clientes_entregado"));
    }

    public function filtrarTodosLosPedidos()
    {
        $pedidos = DB::table('users')
            ->join('pedidos', 'pedidos.cliente_id', '=', 'users.id')
            ->select('users.name', 'pedidos.direccion', 'users.telefono', 'pedidos.id', 'pedidos.envio', 'pedidos.total', 'pedidos.create_time')
            ->get();
        return response()->json($pedidos);
    }

    public function filtrarTodosLosPedidosEntregados()
    {

        $pedidos = DB::table('users')
            ->join('pedidos_entregados', 'pedidos_entregados.cliente_id', '=', 'users.id')
            ->select('users.name', 'pedidos_entregados.direccion', 'users.telefono', 'pedidos_entregados.id', 'pedidos_entregados.envio', 'pedidos_entregados.total', 'pedidos_entregados.create_time')
            ->get();

        return response()->json($pedidos);
    }

    public function orderMoved($id)
    {

        DB::beginTransaction();


        $moverPedido = DB::insert('INSERT INTO pedidos_entregados SELECT * FROM pedidos WHERE id = ?', [$id]);

        $detallesPedido = DB::insert('INSERT INTO order_items_delivereds SELECT * FROM order_items WHERE pedido_id = ?', [$id]);

        if ($moverPedido && $detallesPedido) {

            $detalles = DB::select('SELECT producto_id, cantidad FROM order_items WHERE pedido_id = ?', [$id]);


            foreach ($detalles as $detalle) {
                $producto_id = $detalle->producto_id;
                $cantidad = $detalle->cantidad;

                DB::table('productos')->where('id', $producto_id)->decrement('stock', $cantidad);
            }


            Pedidos::destroy($id);

            DB::commit();

            return response()->json(['message' => '¡Pedido entregado correctamente!']);
        } else {
            DB::rollBack();
            return response()->json(['message' => '¡Error al mover el pedido!'], 500);
        }
    }



    public function destroy($id)
    {

        Pedidos::destroy($id);

        return back()->withSuccess('!Pedido cancelado!');
    }
}
