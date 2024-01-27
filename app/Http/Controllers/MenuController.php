<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function index(){
        $hamburguesas = db::select('SELECT * FROM productos WHERE categoria = "hamburguesa"');
        $bebidas = db::select('SELECT * FROM productos WHERE categoria = "bebida" AND stock >= 1');
        $categorias = Categorias::all();
        $cantidadCarrito = Cart::count();
        return view("menu", compact("hamburguesas","bebidas","cantidadCarrito","categorias"));
    }
}
