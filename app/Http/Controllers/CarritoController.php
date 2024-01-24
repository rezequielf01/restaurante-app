<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productos;
use App\Models\Pedidos;
use App\Models\OrderItem;
use App\Models\PedidosUsuario;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\alert;

class CarritoController extends Controller
{
    public function buy(Request $request){
        $producto = Productos::find($request->id);
        if (!empty($producto)) {
            
            Cart::add(
                $producto->id,
                $producto->nombre,
                1,
                $producto->precio,
                ["imagen"=>$producto->imagen],
            );
            return redirect()->route('carrito.checkout');
        
        }
    }

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
            'cliente_id'=>'required',
            // 'telefono'=>'required',
            'direccion'=>'nullable',
            // 'pedido'=>'required',
            // 'metodo_de_pago'=>'required',
            // 'envio'=>'required',
            // 'total'=>'required',
        ]);

        //UPLOAD PRODUCT
        
        $clienteID = $request->cliente_id;
        // $totalPrice = Cart::Total();

        $pedido = new Pedidos();
        if($request->direccion != ""){
            $pedido->direccion = $request->direccion;
        }
        else{
            $pedido->direccion = auth()->user()->direccion;
        }
        $pedido->cliente_id = $request->cliente_id;
        $totalCarrito = Cart::total();
        $pedido->total = $totalCarrito;

        if ($pedido->save()) {
            $pedidoID = $pedido->id;

            foreach (Cart::content() as $item) {
                OrderItem::create([
                    'pedido_id' => $pedidoID,
                    'producto_id' => $item->id,
                    'nombre' => $item->name,
                    'cantidad' => $item->qty,
                    'precio' => $item->price,
                ]);
            }
            
        }
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
