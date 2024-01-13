@extends('layouts.plantilla')
@section("title","Home")
@section('contenido')
    <div class="hero-container">
        <div class="box-column-flex">

            <div class="hero__h1">Raices Restaurante</div>
            <div class="hero__h2">Cocina casera con historia</div>
            
            
            <div class="hero-btns">
                <a href="{{route("menu")}}" class="hero__btn">
                    <img class="hero-btns__icon" src="images/menu.png" alt="Menú icono">
                    <p class="hero-btns__p p-0 m-0">Menú</p>
                </a>
                <button class="hero__btn" onclick="horariosAlert()">
                    <img class="hero-btns__icon" src="images/reloj.png" alt="Menú icono">
                    <p class="hero-btns__p p-0 m-0">Horarios</p>
                </button>
                <button class="hero__btn" onclick="wifiAlert()">
                    <i class="fa fa-wifi"></i>
                    <p class="hero-btns__p p-0 m-0">Wi-Fi</p>
                </button>
                <a href="#" class="hero__btn">
                    <i class="fa fa-map-marker"></i>
                    <p class="hero-btns__p p-0 m-0">Dirección</p>
                </a>
            </div>
        </div>

    </div>
@endsection
