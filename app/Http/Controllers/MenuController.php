<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use App\Models\Productos;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{

    public function index() {
        $cantidadCarrito = Cart::count();
        $categorias = Categorias::with('productos')->get();
        $productos = Productos::select('*')->get();
        return view('menu', compact("cantidadCarrito",'categorias','productos'));
    }

    public function all() {
        
        $productos = Productos::all();
    
        return response()->json($productos);
    }

    public function cambiarDireccion(Request $request)
    {
    
        $request->validate([
            'nuevaDireccion' => 'required|string',
            'userId' => 'nullable|exists:users,id'
        ]);

        try {
        
            $user = User::findOrFail($request->userId);
        
            $user->direccion = $request->nuevaDireccion;
            $user->save();

            
            return response()->json(['mensaje' => '¡Dirección actualizada correctamente!', 'nuevaDireccion' => $user->direccion], 200);
        } catch (\Exception $e) {
          
            return response()->json(['mensaje' => 'Error al actualizar la dirección del usuario'], 500);
        }
       
    }

    public function categories($categoria_id)
    {
        $productos = Productos::where('categoria_id', $categoria_id)->get();
     
        return response()->json($productos);
    }

    public function add(Request $request)
    {
        $producto = Productos::find($request->id);
        if (!empty($producto)) {

            Cart::add(
                $request->id,
                $request->nombre,
                1,
                $request->precio,
                ["imagen" => $producto->imagen],
            );

            $cantidadCarrito = Cart::count();
            // return back()->withSuccess($producto->nombre.' se agregó al carrito');
            return response()->json(['cantidad' => $cantidadCarrito]);
        }
    }
}
