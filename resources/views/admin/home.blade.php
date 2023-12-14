@extends('adminlte::page')

@section('title', 'Admin panel')

@section('content_header')
    
@stop

@section('content')
    <div class="admin-container">
        
        <h2 class="d-flex flex-column bg-danger text-dark m-0">Panel de administracion</h2>

        <a href="{{route("admin.usuarios")}}" class="card-home-admin card d-flex flex-row btn align-items-center m-0 border-0 text-dark fw-bold bg-light text-light">

            <div style="width:70px; height: 65px" class="card-title">
                <img class="w-100 h-100" src="images/usuarios.png" alt="">
            </div>

            <div class="card-body">
                {{$usuariosRegistrados}}
                <p>Usuarios registrados</p>
            </div>

        </a>

        <a href="{{route("admin.pedidos")}}" class="card-home-admin card d-flex flex-row btn align-items-center m-0 border-0 text-dark fw-bold bg-light text-light">

            <div style="width:70px; height: 65px" class="card-title">
                <img class="w-100 h-100" src="images/pedidos.png" alt="">
            </div>

            <div class="card-body">
                {{$pedidosPendientes}}
                <p>Pedidos pendientes</p>
            </div>

        </a>

        <div class="card-home-admin card d-flex flex-row btn align-items-center m-0 border-0 text-dark fw-bold bg-light text-light">

            <div style="width:70px; height: 65px" class="card-title">
                <img class="w-100 h-100" src="images/cancelado.png" alt="">
            </div>

            <div class="card-body">
                {{$productosRegistrados}}
                <p>Pedidos cancelados</p>
            </div>

        </div>

        <div class="card-home-admin card d-flex flex-row btn align-items-center m-0 border-0 text-dark fw-bold bg-light text-light">

            <div style="width:70px; height: 65px" class="card-title">
                <img class="w-100 h-100" src="images/productos.png" alt="">
            </div>

            <div class="card-body">
                {{$productosRegistrados}}
                <p>Cantidad de productos</p>
            </div>

        </div>

        

    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop