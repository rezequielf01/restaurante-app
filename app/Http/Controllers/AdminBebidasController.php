<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminBebidasController extends Controller
{
    public function show(){
        $bebidas = db::select('SELECT * FROM productos WHERE categoria = "bebida"');
        return view("admin.productos-bebidas", compact("bebidas"));
    }
}
