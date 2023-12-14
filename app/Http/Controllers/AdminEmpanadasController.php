<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminEmpanadasController extends Controller
{
    public function show(){
        $empanadas = db::select('SELECT * FROM productos WHERE categoria = "empanada"');
        return view("admin.productos-empanadas", compact("empanadas"));
    }
}
