<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminHamburgesasController extends Controller
{
    public function show(){
        $hamburgesas = db::select('SELECT * FROM productos WHERE categoria = "hamburgesa"');
        return view("admin.productos-hamburgesas", compact("hamburgesas"));
    }

    public function foods(){
        $comidas = db::select('SELECT * FROM productos WHERE categoria = "pizza" OR categoria = "hamburgesa"');
        return view("admin.comidas", compact("comidas"));
    }
}
