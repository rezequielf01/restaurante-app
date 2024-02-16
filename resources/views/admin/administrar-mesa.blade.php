@extends('adminlte::page')

@section('title', 'Lista de pedidos')

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="{{ asset('/css/index.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/responsive.css') }}" rel="stylesheet">
@stop

@section('content_header')
    <div class="admin-header">
        <span class="admin-title-header__span">
            <img class="admin-title-header__img" src="/restaurante-app/public/images/mesa.png" alt="Mesa icono png">
        </span>
        <h2 class="admin-title-header__h2">Administrar mesa #{{ $mesa->nro_mesa }}</h2>
    </div>
@stop

@section('content')

    @if (session('success'))
        <div class="alert alert-success alert-block">
            <strong>{{ session('success') }}</strong>
        </div>
    @endif

    <div class="mesas-container d-flex gap-3">

        <div class="mesa-categoria w-25 bg-light shadow-lg p-3 rounded">
            <h3 class="w-100 d-flex align-items-center justify-content-center bg-dark p-1 rounded text-center">Lista de
                categorias</h3>
            <ol style="list-style-type: none"
                class="w-100 d-flex flex-column gap-3 align-items-center justify-content-center">
                @foreach ($categorias as $categoria)
                    <li>
                        <button class="btn p-1" style="min-width: 120px; background: var(--color-principal)"
                            type="button">{{ $categoria->nombre }}</button>
                    </li>
                @endforeach
            </ol>
        </div>

        <div class="mesa-productos bg-light shadow-lg p-3 w-75">
            <h3 class="m-0 w-100 bg-dark p-1 rounded text-center">Lista de productos</h3>
            <div class="container d-flex gap-3 p-2 flex-wrapp">
                @foreach ($productos as $producto)
                    <form class="mesa-card-form"
                        action="{{ route('admin.agregar.producto.mesa', ['mesaId' => $mesa->id]) }}" method="post">
                        @csrf
                        <div class="card bg-white shadow-lg m-0">
                            <div class="card-body p-2">
                                <img class="mesa-card__img" src="/restaurante-app/public/productos/{{ $producto->imagen }}"
                                    alt="">
                                <span class="food__precio">${{ $producto->precio }}</span>
                                <p class="m-0">{{ $producto->nombre }}</p>
                                <input type="hidden" name="productoId" value="{{ $producto->id }}">
                                <div class="d-flex align-items-center w-100">
                                    <p class="p-0 m-0">Cantidad: </p>
                                    <input class="mesa-card__cantidad w-50" placeholder="1" type="number" name="cantidad">
                                </div>
                                {{-- <input type="number" name="cantidad" --}}
                            </div>
                            <div class="card-footer w-100 d-flex align-items-center justify-content-center">
                                <button title="Agregar" class="btn" style="background: var(--color-principal)"
                                    type="submit">Agregar</button>
                            </div>
                        </div>
                    </form>
                @endforeach
            </div>
        </div>

    </div>




    <div class="d-flex flex-column mt-3 w-100">

        <div class="w-100 gap-3 d-flex">

            <div class="d-flex flex-column shadow-lg gap-2 w-75 p-3 bg-light">

                <h3 class="m-0 w-100 bg-dark p-1 rounded text-center">Productos en mesa</h3>

                <div class="mesa-lista-consumido d-flex w-100 p-2 ps-0 gap-3">
                    @foreach ($mesa->productos as $producto)
                        <form action="{{ route('admin.restar.producto.mesa', ['mesaId' => $mesa->id]) }}" method="get"
                            style="width: 15%; height: 200px">
                            <div class="card-mesa-consumido card w-100 h-100 shadow-lg bg-white m-0">
                                <div class="card-body p-0">
                                    <img class="mesa-card__img"
                                        src="/restaurante-app/public/productos/{{ $producto->imagen }}" alt="">
                                    <span class="food__precio">x{{ $producto->pivot->producto_cantidad }}</span>
                                    <p class="m-0 p-1 text-center">{{ $producto->nombre }}</p>
                                    <div class="w-100 d-flex gap-2 align-items-center justify-content-center">
                                        <input class="w-25" type="number" placeholder="1" name="cantidad2">
                                        <button style="background: var(--color-principal);" title="Restar" class="btn"
                                            type="submit">Restar
                                        </button>
                                    </div>
                                    <input type="hidden" name="productoId" value="{{ $producto->id }}">
                                    {{-- <input type="number" name="cantidad" --}}
                                </div>
                            </div>
                        </form>
                    @endforeach
                </div>

            </div>

            <div class="d-flex flex-column w-25 bg-light shadow-lg text-center p-3">

                <h3 class="w-100 bg-dark p-1 rounded text-center">Ticket</h3>

                <form id="formulario-ticket"
                    class="w-100 h-100 gap-2 d-flex flex-column align-items-start justify-content-center"
                    action="{{ route('admin.cerrar.mesa', ['mesaId' => $mesa->id]) }}" method="post">
                    @csrf

                    <label for="cajero">Cajero/a:
                        <input class="rounded shadow-lg" style="border: solid 1px #d1d1d1" type="text" name="cajero"
                            id="cajero" placeholder="{{ auth()->user()->name }}" value="{{ auth()->user()->name }}">
                    </label>

                    <label for="cliente">Cliente:
                        <input class="rounded shadow-lg" style="border: solid 1px #d1d1d1" type="text" name="cliente"
                            id="cliente">
                    </label>

                    <label for="medioDePago">Medio de pago:
                        <select name="medioDePago" id="medioDePago" required>
                            <option value="efectivo">Efectivo</option>
                            <option value="transferencia">Transferencia</option>
                            <option value="tarjeta">Tarjeta</option>
                        </select>
                    </label>

                    <label for="total">Total:
                        <span>${{ number_format($total, 3, '.', ',') }}</span>
                        <input type="hidden" id="total" name="total"
                            value="{{ number_format($total, 3, '.', ',') }}">
                    </label>

                    <div class="d-flex w-100 gap-2">
                        <input type="hidden" name="ventaId" id="accion" value="">
                        <button title="Cerrar mesa" type="submit" class="btn bg-success">Cerrar mesa <i
                                class="fa fa-check-circle-o" aria-hidden="true"></i></button>
                        @if ($ventaId > 0)
                            <a href="{{ route('admin.fpdf.venta.local', $ventaId) }}" target="_blank"
                                title="Imprimir factura"
                                style="color: white; background: rgb(33, 118, 255); box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);"
                                class="btn">Imprimir ticket
                                <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                            </a>
                        @else
                            <button title="Limpiar mesa" disabled type="button" class="btn bg-primary">Imprimir factura
                                <i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>
                        @endif
                    </div>

                </form>

            </div>
        </div>

    </div>


@stop

@section('js')

    <script>
        $(document).ready(function() {
            $('#formulario-ticket').submit(function(event) {
                // Evitar que se envíe el formulario automáticamente
                event.preventDefault();

                // Obtener valores de los campos
                var total = $('#total').val();

                // Validar campos
                if (total > 0) {

                    this.submit();
                } else {
                    Swal.fire({
                        title: "Error",
                        text: "No se encontraron prodúctos en la mesa!",
                        icon: "error",
                        confirmButtonColor: '#343a40',
                    });
                }


            });
        });
    </script>

    <script src="https://kit.fontawesome.com/18e24e909e.js" crossorigin="anonymous"></script>

@stop
