@extends('adminlte::page')

@section('title', 'Lista de pedidos')

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="{{ asset('/css/index.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/responsive.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
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

    @if (session('mesaLiberada'))
        {{-- <div class="alert alert-success alert-block">
            <strong>{{ session('mesaLiberada') }}</strong>
        </div> --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Toastify({
                    text: '{{ session('mesaLiberada') }}',
                    duration: 4000, // Duración de la notificación en milisegundos
                    close: true, // Habilitar botón de cierre
                    gravity: 'top', // Posición de la notificación (top, bottom)
                    position: 'right', // Posición de la notificación (left, center, right)
                    offset: {
                        x: 0, // Distancia desde el borde derecho de la ventana del navegador
                        y: 50 // Distancia desde la parte superior de la ventana del navegador
                    },
                    backgroundColor: "#29d167", // Color de fondo de la notificación
                    stopOnFocus: true // Detener la duración al enfocar
                }).showToast();
            });
        </script>
    @elseif(session('productoAgregado'))
        <script></script>
    @endif

    <div class="mesas-container d-flex gap-3">

        <div class="mesa-categoria w-25 bg-light shadow-lg p-3 rounded">
            <h3 class="w-100 d-flex align-items-center justify-content-center bg-dark p-1 rounded text-center">Categorias
            </h3>
            <ol style="list-style-type: none"
                class="w-100 d-flex flex-column gap-3 align-items-center justify-content-center data-categoria-id">
                <li>
                    <button data-categoria-id="todos" class="btn p-1 btn-categoria"
                        style="min-width: 120px; background: var(--color-principal)" type="button">Mostrar todo</button>
                </li>
                @foreach ($categorias as $categoria)
                    <li>
                        <button data-categoria-id="{{ $categoria->id }}" class="btn p-1 btn-categoria"
                            style="min-width: 120px; background: var(--color-principal)"
                            type="button">{{ $categoria->nombre }}</button>
                    </li>
                @endforeach
            </ol>
        </div>

        <div class="mesa-productos bg-light shadow-lg p-3 w-75">
            <h3 class="m-0 w-100 bg-dark p-1 rounded text-center">Lista de productos</h3>
            <div class="container mesa-lista-productos d-flex flex-wrap gap-3 pt-3"
                style="max-height: 90%; overflow-y: auto;">

            </div>
        </div>

    </div>




    <div class="d-flex flex-column mt-3 w-100">

        <div class="w-100 gap-3 d-flex">

            <div class="d-flex flex-column shadow-lg gap-2 w-75 p-3 bg-light">

                <h3 class="m-0 w-100 bg-dark p-1 rounded text-center">Productos en mesa</h3>

                <div id="mesa-lista-consumido" class="mesa-lista-consumido d-flex w-100 p-2 ps-0 gap-3">
                    
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
                        <span id="precio-total">${{ number_format($total, 3, '.', ',') }}</span>
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


<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
@section('js')


    <script>
        var productoAgregadoMsg = {{ json_encode(session('productoAgregado')) }};
        $(document).ready(function() {

            $.ajax({
                        url: '{{ route('admin.todos.los.producto') }}',
                        type: 'GET',
                        success: function(respuesta) {
                            // Manejar la respuesta y mostrar los productos filtrados
                            actualizarListaProductos(respuesta);
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
            });

            actualizarListaProductosEnMesa();

            // ACTUALIZAR LA LISTA DE PRODUCTOS CON AJAX
            function actualizarListaProductos(productos) {
                // Limpiar la lista de productos
                $('.mesa-lista-productos').empty();

                    // Iterar sobre los productos recibidos y agregarlos al contenedor
                    productos.forEach(function(producto) {
                        // Construir el HTML para cada producto
                        var html = `
                        <form class="mesa-card-form" id="form-producto-${producto.id}"
                            data-producto-id="${producto.id}"
                            action="{{ route('admin.guardar.producto.mesa', ['mesaId' => $mesa->id]) }}" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="card bg-white shadow-lg m-0">
                                <div class="card-body p-2">
                                    <img class="mesa-card__img" src="/restaurante-app/public/productos/${producto.imagen}" alt="">
                                    <span class="food__precio">$${producto.precio}</span>
                                    <p class="m-0">${producto.nombre}</p>
                                    <input type="hidden" name="productoId" value="${producto.id}">
                                    <div class="d-flex align-items-center w-100">
                                        <p class="p-0 m-0">Cantidad: </p>
                                        <input class="mesa-card__cantidad w-50" placeholder="1" type="number" name="cantidad">
                                    </div>
                                </div>
                                <div class="card-footer w-100 d-flex align-items-center justify-content-center">
                                    <button title="Agregar" class="btn btn-agregar-producto"
                                        style="background: var(--color-principal)" type="submit">Agregar</button>
                                </div>
                            </div>
                        </form>
                        `;

                        // Agregar el producto al contenedor de productos
                        $('.mesa-lista-productos').append(html);
                    });
            }

            // FILTRAR POR CATEGORIAS CON AJAX
            $('.btn-categoria').click(function() {

                var categoriaId = $(this).data('categoria-id');

                if (categoriaId >= 1) {
                    // Se ha seleccionado una categoría específica
                    $.ajax({
                        url: '{{ route('admin.filtrar.producto', ['categoria_id' => ':categoria_id']) }}'.replace(':categoria_id', categoriaId),
                        type: 'GET',
                        success: function(respuesta) {
                            // Manejar la respuesta y mostrar los productos filtrados
                            actualizarListaProductos(respuesta);

                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                } else {
                    $.ajax({
                        url: '{{ route('admin.todos.los.producto') }}',
                        type: 'GET',
                        success: function(respuesta) {
                            // Manejar la respuesta y mostrar los productos filtrados
                            actualizarListaProductos(respuesta);
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                }

            });

           // Utilizar delegación de eventos para manejar clics en botones de agregar producto
            $(document).on('click', '.btn-agregar-producto', function(event) {
                event.preventDefault(); // Evitar el comportamiento predeterminado del botón

                var form = $(this).closest('form'); // Encuentra el formulario más cercano
                var formData = form.serialize(); // Serializa los datos del formulario

                $.ajax({
                    url: form.attr('action'), // Obtiene la URL del formulario
                    type: form.attr('method'), // Obtiene el método del formulario (POST en este caso)
                    data: formData, // Envía los datos del formulario
                    success: function(response) {
                        // Maneja la respuesta del servidor (si es necesario)
                        if (response.mensaje == "Ingrese un número mayor a 0") {
                            Swal.fire({
                                icon: "error",
                                title: "Error",
                                text: response.mensaje,
                                confirmButtonColor: '#0c0c0c'
                            });
                        } else {
                            Toastify({
                                text: response.mensaje,
                                duration: 3000, // Duración de la notificación en milisegundos
                                close: true, // Habilitar botón de cierre
                                gravity: 'top', // Posición de la notificación (top, bottom)
                                position: 'right', // Posición de la notificación (left, center, right)
                                offset: {
                                    x: 0, // Distancia desde el borde derecho de la ventana del navegador
                                    y: 50 // Distancia desde la parte superior de la ventana del navegador
                                },
                                backgroundColor: "#29d167", // Color de fondo de la notificación
                                stopOnFocus: true // Detener la duración al enfocar
                            }).showToast();
                        }

                        // Actualiza la lista de productos en la interfaz de usuario
                        actualizarListaProductosEnMesa(); // Cambiado el nombre de la función
                        // Actualizar el precio total en la interfaz de usuario
                        $('#precio-total').text("$"+response.total);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error al agregar producto a la mesa:', error);
                    }
                });
            });
        
            // Función para mostrar los productos de la mesa cuando la página se carga
            function actualizarListaProductosEnMesa() {
                $.ajax({
                    type: 'GET',
                    url: '{{ route('admin.productos.en.mesa', ['mesaId' => $mesa->id]) }}',
                    success: function(response) {

                        // Limpiar la lista de productos de la mesa
                        $('#mesa-lista-consumido').empty();

                        // Recorrer los productos recibidos y agregarlos a la lista
                        response.productos.forEach(producto => {
                            var productoHtml = '<form id="restar-form" action="{{ route('admin.restar.producto.mesa', ['mesaId' => $mesa->id]) }}" method="get" style="width: 20%; height: 250px;">';
                            productoHtml += '<div class="card-mesa-consumido card w-100 h-100 shadow-lg bg-white m-0">';
                            productoHtml += '<div class="card-body p-0">';
                            productoHtml += '<img class="mesa-card__img" src="/restaurante-app/public/productos/'+producto.imagen+'" alt="">';
                            productoHtml += '<span class="food__precio">x'+producto.cantidad+'</span>';
                            productoHtml += '<p class="m-0 p-1 text-center">'+producto.nombre+'</p>';
                            productoHtml += '<div class="w-100 d-flex gap-2 align-items-center justify-content-center">';
                            productoHtml += '<input class="w-25" type="number" placeholder="1" name="cantidad2">';
                            productoHtml += '<button style="background: var(--color-principal);" title="Restar" class="btn btn-restar-producto" type="submit">Restar</button>';
                            productoHtml += '</div>';
                            productoHtml += '<input type="hidden" name="productoId" value="'+producto.id+'">';
                            productoHtml += '</div>';
                            productoHtml += '</div>';
                            productoHtml += '</form>';
                            $('#mesa-lista-consumido').append(productoHtml);
                        });

                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }    

            $(document).on('click', '.btn-restar-producto', function(event) {
                event.preventDefault(); // Evitar el comportamiento predeterminado del botón

                var form = $('#restar-form');
                var formData = form.serialize(); // Serializa los datos del formulario

                $.ajax({
                    url: form.attr('action'), // Obtiene la URL del formulario
                    type: form.attr('method'), // Obtiene el método del formulario (POST en este caso)
                    data: formData, // Envía los datos del formulario
                    success: function(response) {
                        // Maneja la respuesta del servidor (si es necesario)
                        if (response.mensaje == "Ingrese un número mayor a 0") {
                            Swal.fire({
                                icon: "error",
                                title: "Error",
                                text: response.mensaje,
                                confirmButtonColor: '#0c0c0c'
                            });
                        } else {
                            Toastify({
                                text: response.mensaje,
                                duration: 3000, // Duración de la notificación en milisegundos
                                close: true, // Habilitar botón de cierre
                                gravity: 'top', // Posición de la notificación (top, bottom)
                                position: 'right', // Posición de la notificación (left, center, right)
                                offset: {
                                    x: 0, // Distancia desde el borde derecho de la ventana del navegador
                                    y: 50 // Distancia desde la parte superior de la ventana del navegador
                                },
                                backgroundColor: "#29d167", // Color de fondo de la notificación
                                stopOnFocus: true // Detener la duración al enfocar
                            }).showToast();
                        }

                        // Actualiza la lista de productos en la interfaz de usuario
                        actualizarListaProductosEnMesa(); // Cambiado el nombre de la función
                        // Actualizar el precio total en la interfaz de usuario
                        $('#precio-total').text("$" + response.total);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error al agregar producto a la mesa:', error);
                    }
                });
            });
          
            // VALIDAR FORMULARIO ANTES DE CERRAR MESA
            $('#formulario-ticket').submit(function(event) {
                // Evitar que se envíe el formulario automáticamente
                event.preventDefault();

                // Obtener la cantidad de productos en la mesa
                var cantidadProductos = $('#mesa-lista-consumido .card-mesa-consumido').length;

                // Validar si hay productos en la mesa
                if (cantidadProductos > 0) {
                    // Si hay productos, enviar el formulario
                    this.submit();
                } else {
                    // Si no hay productos, mostrar un mensaje de error
                    Swal.fire({
                        title: "Error",
                        text: "No se encontraron productos en la mesa!",
                        icon: "error",
                        confirmButtonColor: '#343a40',
                    });
                }

            });
            
        });
    </script>

    <script src="https://kit.fontawesome.com/18e24e909e.js" crossorigin="anonymous"></script>

@stop
