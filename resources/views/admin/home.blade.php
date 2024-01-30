@extends('adminlte::page')

@section('title', 'Admin panel')

@section('content_header')

@stop

@section('content')

    <div class="admin-container">

        <p style="opacity: 0">.</p>

        <div class="shadow-lg">
            <h2 style="background: #343a40" class="d-flex flex-column text-light p-2 mt-3 mb-0 text-center">Panel de administracion</h2>

            <div class="d-flex flex-wrap gap-3 p-3 align-items-center justify-content-center">

                <div class="small-box" style="width: 300px; background:#343a40;">
                    <div class="d-flex align-items-center justify-content-around">
                        <div style="color: #f1f1f1" class="inner">
                            <h3 style="opacity: 0">0</h3>
                            <p>Caja registradora</p>
                        </div>
                        <div style="width:70px; height: 65px" class="card-title">
                            <img style="filter: invert(1)" class="w-100 h-100" src="images/caja-registradora.png" alt="Usuario png">
                        </div>
                    </div>
                    <a href="#" class="small-box-footer">Más informacion <i class="fas fa-arrow-circle-right"></i></a>
                </div>

                <div class="small-box" style="width: 300px; background:#343a40;">
                    <div class="d-flex align-items-center justify-content-around">
                        <div style="color: #f1f1f1" class="inner">
                            <h3>{{ $usuariosRegistrados }}</h3>
                            <p>Clientes registrados</p>
                        </div>
                        <div style="width:70px; height: 65px" class="card-title">
                            <img style="filter: invert(1)" class="w-100 h-100" src="images/usuarios.png" alt="Usuario png">
                        </div>
                    </div>
                    <a href="{{ route('admin.usuarios') }}" class="small-box-footer">Más informacion <i class="fas fa-arrow-circle-right"></i></a>
                </div>

                <div class="small-box" style="width: 300px; background:#343a40;">
                    <div class="d-flex align-items-center justify-content-around">
                        <div style="color: #f1f1f1" class="inner">
                            <h3>{{ $pedidosPendientes }}</h3>
                            <p>Pedidos pendientes</p>
                        </div>
                        <div style="width:70px; height: 65px" class="card-title">
                            <img style="filter: invert(1)" class="w-100 h-100" src="images/pedidos.png" alt="">
                        </div>
                    </div>
                    <a href="{{ route('admin.pedidos') }}" class="small-box-footer">Más informacion <i class="fas fa-arrow-circle-right"></i></a>
                </div>

                <div class="small-box" style="width: 300px; background:#343a40;">
                    <div class="d-flex align-items-center justify-content-around">
                        <div style="color: #f1f1f1" class="inner">
                            <h3>{{ $pedidosEntregados }}</h3>
                            <p>Pedidos entregados</p>
                        </div>
                        <div style="width:70px; height: 65px" class="card-title">
                            <img style="filter: invert(1);" class="w-100 h-100" src="images/pedidos.png" alt="">
                        </div>
                    </div>
                    <a href="{{ route('admin.pedidos.entregados') }}" class="small-box-footer">Más informacion <i class="fas fa-arrow-circle-right"></i></a>
                </div>

                <div class="small-box" style="width: 300px; background:#343a40;">
                    <div class="d-flex align-items-center justify-content-around">
                        <div style="color: #f1f1f1" class="inner">
                            <h3>
                            
                                {{$ingresosMensuales}}                            

                            </h3>
                            <p>Ingresos mensuales</p>
                        </div>
                        <div style="width:70px; height: 65px" class="card-title">
                            <img style="filter: invert(1);" class="w-100 h-100" src="images/moneda.png" alt="">
                        </div>
                    </div>
                    <a href="{{ route('admin.productos') }}" class="small-box-footer">Más informacion <i class="fas fa-arrow-circle-right"></i></a>
                </div>

            </div>
        </div>



    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="{{ asset('/css/index.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/responsive.css') }}" rel="stylesheet">
@stop
