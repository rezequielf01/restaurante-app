<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminUsuariosController extends Controller
{
    public function show(){
        $usuarios = db::select('SELECT * FROM users');
        return view("admin.usuarios", compact("usuarios"));
    }

}
