@extends('layouts.plantilla')
@section("title","Home")
@section('contenido')
    <div class="hero-container">
        <div class="box-column-flex">

            <div class="hero__h1">Raices Restaurante</div>
            <div class="hero__h2">Cocina casera con historia</div>
            
            <a href="#" class="hero__ubicacion">
                <i class="hero__ubicacion-icono fa fa-map-marker" aria-hidden="true"></i>
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Doloremque, enim.
            </a>

            <div class="hero-btns">
                <a href="{{route("menu")}}" class="hero__btn hero__btn">Menu</a>
                <button class="hero__btn" onclick="horariosAlert()">Horarios</button>
                <button class="hero__btn" onclick="wifiAlert()">Clave WIFI</button>
            </div>
        </div>

    </div>
@endsection
