<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productos;
use App\Models\Pedidos;
use App\Models\PedidosUsuario;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\alert;

class CarritoController extends Controller
{
    public function add(Request $request){
        $producto = Productos::find($request->id);
        if (!empty($producto)) {
            
            Cart::add(
                $producto->id,
                $producto->nombre,
                1,
                $producto->precio,
                ["imagen"=>$producto->imagen],
            );
            return back()->withSuccess($producto->nombre.' se agregó al carrito');
        
        }
    }

    public function checkout(){
        if(auth()->user() == null) {
            return view("auth.login");
        }
        else {
            return view("cart.checkout");
        }
    }

    public function deleteItem(Request $request){
        Cart::remove($request->rowId);  
        return back()->withDanger('Producto eliminado!');
    }

    public function clear(){
        Cart::destroy();
        return back()->withSuccess('Carrito vaciado!');
    }

    public function sendOrder(request $request){

        $request->validate([
            'cliente'=>'required',
            'telefono'=>'required',
            'direccion'=>'required',
            'pedido'=>'required',
            'metodo_de_pago'=>'required',
            'envio'=>'required',
            'total'=>'required',
        ]);

        //UPLOAD PRODUCT
        $pedido = new Pedidos();
        $pedido->cliente = $request->cliente;
        $pedido->telefono = $request->telefono;
        $pedido->direccion = $request->direccion;
        $pedido->pedido = $request->pedido;
        $pedido->metodo_de_pago = $request->metodo_de_pago;
        $pedido->envio = $request->envio;
        $pedido->total = $request->total;
        $pedido->save();

        Cart::destroy();
        return back()->withSuccess('¡Su pedido a sido enviado!');
        
    }

    public function incrementarCantidad(Request $request){
        $item = Cart::content()->where("rowId", $request->id)->first();
        Cart::update($request->id,["qty"=>$item->qty+1]);
        return back()->withSuccess($item->name.' (+)');
    }

    public function restarCantidad(Request $request){
        $item = Cart::content()->where("rowId", $request->id)->first();
        Cart::update($request->id,["qty"=>$item->qty-1]);
        return back()->withDanger($item->name.' (-)');
    }

}
