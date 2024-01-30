<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminCajaController extends Controller
{
    public function show(){
        view("admin.caja-registradora");
    }
}
