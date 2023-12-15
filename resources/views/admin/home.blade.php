@extends('adminlte::page')

@section('title', 'Admin panel')

@section('content_header')

@stop

@section('content')

    <div class="admin-container">

        <p style="opacity: 0">.</p>

        <div class="shadow-lg">
            <h2 class="d-flex flex-column bg-dark text-light p-2 mt-3 mb-0 text-center">Panel de administracion</h2>
            
            <div class="d-flex flex-wrap gap-3 p-3 align-items-center justify-content-center">

                <a href="{{ route('admin.usuarios') }}" class="card-home-admin card d-flex flex-row btn align-items-center m-0 border-0 text-dark fw-bold bg-light text-light">
                    <div style="width:70px; height: 65px" class="card-title">
                        <img class="w-100 h-100" src="images/usuarios.png" alt="">
                    </div>

                    <div class="card-body">
                        <span>
                            {{ $usuariosRegistrados }}
                        </span>
                        <p>Clientes registrados</p>
                    </div>
                </a>

                <a href="{{ route('admin.pedidos') }}" class="card-home-admin card d-flex flex-row btn align-items-center m-0 border-0 text-dark fw-bold bg-light text-light">
                    <div style="width:70px; height: 65px" class="card-title">
                        <img class="w-100 h-100" src="images/pedidos.png" alt="">
                    </div>

                    <div class="card-body">
                        <span>
                            {{ $pedidosPendientes }}
                        </span>
                        <p>Pedidos pendientes</p>
                    </div>
                </a>

                <a href="{{ route('admin.usuarios') }}" class="card-home-admin card d-flex flex-row btn align-items-center m-0 border-0 text-dark fw-bold bg-light text-light">
                    <div style="width:70px; height: 65px" class="card-title">
                        <img class="w-100 h-100" src="images/productos.png" alt="">
                    </div>

                    <div class="card-body">
                        <span>
                            {{ $productosRegistrados }}
                        </span>
                        <p>Producto totales</p>
                    </div>
                </a>

                <a href="{{ route('admin.usuarios') }}" class="card-home-admin card d-flex flex-row btn align-items-center m-0 border-0 text-dark fw-bold bg-light text-light">
                    <div style="width:70px; height: 65px" class="card-title">
                        <img class="w-100 h-100" src="images/usuarios.png" alt="">
                    </div>

                    <div class="card-body">
                        <span>
                            {{ $usuariosRegistrados }}
                        </span>
                        <p>Usuarios registrados</p>
                    </div>
                </a>

                <a href="{{ route('admin.usuarios') }}" class="card-home-admin card d-flex flex-row btn align-items-center m-0 border-0 text-dark fw-bold bg-light text-light">
                    <div style="width:70px; height: 65px" class="card-title">
                        <img class="w-100 h-100" src="images/usuarios.png" alt="">
                    </div>

                    <div class="card-body">
                        <span>
                            {{ $usuariosRegistrados }}
                        </span>
                        <p>Usuarios registrados</p>
                    </div>
                </a>

                <a href="{{ route('admin.usuarios') }}" class="card-home-admin card d-flex flex-row btn align-items-center m-0 border-0 text-dark fw-bold bg-light text-light">
                    <div style="width:70px; height: 65px" class="card-title">
                        <img class="w-100 h-100" src="images/usuarios.png" alt="">
                    </div>

                    <div class="card-body">
                        <span>
                            {{ $usuariosRegistrados }}
                        </span>
                        <p>Usuarios registrados</p>
                    </div>
                </a>

                {{-- <a href="{{ route('admin.pedidos') }}"
                    class="card-home-admin card d-flex flex-row btn align-items-center m-0 border-0 text-dark fw-bold bg-light text-light">

                    <div style="width:70px; height: 65px" class="card-title">
                        <img class="w-100 h-100" src="images/pedidos.png" alt="">
                    </div>

                    <div class="card-body">
                        {{ $pedidosPendientes }}
                        <p>Pedidos pendies</p>
                    </div>

                </a>

                <div
                    class="card-home-admin card d-flex flex-row btn align-items-center m-0 border-0 text-dark fw-bold bg-light text-light">

                    <div style="width:70px; height: 65px" class="card-title">
                        <img class="w-100 h-100" src="images/cancelado.png" alt="">
                    </div>

                    <div class="card-body">
                        {{ $productosRegistrados }}
                        <p>Pedidos cancelados</p>
                    </div>

                </div>

                <div
                    class="card-home-admin card d-flex flex-row btn align-items-center m-0 border-0 text-dark fw-bold bg-light text-light">

                    <div style="width:70px; height: 65px" class="card-title">
                        <img class="w-100 h-100" src="images/productos.png" alt="">
                    </div>

                    <div class="card-body">
                        {{ $productosRegistrados }}
                        <p>Productos totales</p>
                    </div>

                </div> --}}
            </div>
        </div>



    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="{{ asset('/css/index.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/responsive.css') }}" rel="stylesheet">
@stop
