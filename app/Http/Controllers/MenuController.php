<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function index(){
        $hamburgesas = db::select('SELECT * FROM productos WHERE categoria = "hamburgesa"');
        $bebidas = db::select('SELECT * FROM productos WHERE categoria = "bebida" AND stock >= 1');
        $cantidadCarrito = Cart::count();
        return view("menu", compact("hamburgesas","bebidas","cantidadCarrito"));
    }
}
