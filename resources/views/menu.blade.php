@extends('layouts.plantilla')

@section('title', 'Menu')

@section('css')
    <link href="{{ asset('/css/slick.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/slick-theme.css') }}" rel="stylesheet">
@endsection

@section('contenido')

    <a href="#" class="float-btn-wsp">
        <i class="fa fa-whatsapp float-btn-wsp__icon"></i>
    </a>

    <nav class="nav-mobile text-danger">
        
        <a href="{{ route('carrito.checkout') }}" class="cart m-2 d-flex flex-column align-items-center justify-content-center" style="text-decoration: none">
            <div class="d-flex align-items-center justify-content-center gap-1">
                <i class="carrito__icon fa fa-shopping-cart" style="color: var(--color-principal)" aria-hidden="true"></i>
                <span id="cantidadCarrito2" data-id="{{ Cart::count() }}" class="card__count" style="color: black;">{{ Cart::count() }}</span>
            </div>
            <span class="nm-mobile__span">Carrito</span>
        </a>

        <a href="{{ route('menu') }}" class="cart m-2 d-flex flex-column align-items-center justify-content-center" style="text-decoration: none">
            <i class="fa fa-home nm-icons" aria-hidden="true"></i>
            <span class="nm-mobile__span">Menú</span>
        </a>

        <div class="user-container d-flex flex-column-reverse">

            <span class="nm-mobile__span">Perfil</span>

            @auth
                @php
                    $userName = auth()->user()->name;
                    $userDireccion = auth()->user()->direccion;
                @endphp

                <div>

                    <div class="dropdown">
                        <button class="btn p-0 dropdown-toggle d-flex align-items-center justify-content-center" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">

                            <i class="fa fa-user" style="font-size: 1.2rem; color: var(--color-principal)" aria-hidden="true"></i>
        
                        </button>

                        <ul class="dropdown-menu p-0" style="min-width: 180px; background: linear-gradient(to right, black, #0c0c0c);" aria-labelledby="dropdownMenuButton1">

                            <li class="dropdown-menu__link">
                                <a href="#" id="cambiar-direccion" class="d-block p-2" style="text-decoration: none; font-size: 1rem">
                                    <i class="fa fa-map-marker" style="color: var(--color-principal)" aria-hidden="true"></i>
                                    Cambiar direccion
                                </a>
                            </li>

                            <li class="dropdown-menu__link">
                                <a class="d-block p-2" style="text-decoration: none;" href="javascript:void"
                                onclick="$('#logout-form').submit();">
                                <i class="fa fa-sign-out" style="color: var(--color-principal)" aria-hidden="true"></i>
                                Salir
                                </a>
                            </li>

                        </ul>
                    </div>

                </div>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
            @else

        <div>

            <div class="dropdown">
                <button class="btn dropdown-toggle d-flex align-items-center justify-content-center" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">

                    <i class="fa fa-user" style="font-size: 1.2rem; color: var(--color-principal)" aria-hidden="true"></i>

                </button>

                <ul class="dropdown-menu p-0" style="min-width: 180px; background: linear-gradient(to right, black, #0c0c0c);" aria-labelledby="dropdownMenuButton1">

                    <li class="dropdown-menu__link">
                        <a href="login" class="d-block p-2" style="text-decoration: none; font-size: 1rem">
                            Ingresar
                        </a>
                    </li>

                    <li class="dropdown-menu__link">
                        <a href="register" class="d-block p-2" style="text-decoration: none; font-size: 1rem">
                            Registrarse
                        </a>
                    </li>

                </ul>
            </div>
            @endauth
            
        </div>

        
        
    </nav>

    <div class="contenedor-principal">
        <div class="hero-contenedor">
            <img class="hero__img"
                        src="images/food-banner.png">
        </div>

        <div class="categories" style="background: transparent">

            <div class="categoria-actual">
                <h2>Ver todo</h2>
            </div>

            <div class="lista-categorias">
                <a href="{{ route('menu.todos') }}" class="categories-box" id="categoria-todo">
                    <span class="categories-box__p">Ver todo</span>
                </a>
                @foreach ($categorias as $categoria)
                    <a href="#{{ $categoria->nombre }}" class="categories-box" data-id="{{$categoria->id}}" data-nombre="{{$categoria->nombre}}">
                        <span class="categories-box__p">{{ $categoria->nombre }}</span>
                    </a>
                @endforeach
            </div>

        </div>

        <section class="foods-section" id="foods-section">

            <div id="loader" style="display: none;">Loading...</div>

            @foreach ($productos as $producto)
            
                    
                    <div class="producto-card" id="{{$producto->nombre}}" data-id="{{ $producto->id }}" data-nombre="{{ $producto->nombre }}" data-precio="{{ $producto->precio }}">
    
                        <div class="producto-card-img">
                            <img class="" src="productos/{{ $producto->imagen }}" alt="">
                        </div>
    
                        <div class="producto-card-info">
    
                            <div class="producto-info-titulo">
                                <h3 class="producto-titulo__h3">{{$producto->nombre}}</h3>
                                <span class="producto-titulo__precio">${{$producto->precio}}</span>
                            </div>
    
                            <div class="food-btns">
                                @auth
                                    {{-- COMPRAR --}}
                                    <form action="{{ route('carrito.buy') }}" id="formAdd" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" id="idProducto"
                                            value="{{ $producto->id }}">
                                        <div class="d-flex justify-content-center">
                                            <button type="submit" name="submitForm" id="submitForm"
                                                class="food-btns__btn btn" style="background: var(--color-principal)">
                                                <p class="food-btns__p">Comprar</p>
                                            </button>
                                        </div>
                                    </form>

                                    <button type="button" name="submitForm" id="submitForm"
                                        class="agregar-carrito p-2 w-50 d-flex align-items-center justify-content-center food-btns__btn btn border-0">
                                        <a style="text-decoration:none; display:block;"
                                            class="font-semibold focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                                            <i id="foodBtnsCart" class="fa fa-cart-plus food-btns__icon" aria-hidden="true"> Agregar</i>
                                            <i id="foodBtnPlus" class="fa fa-plus" aria-hidden="true"></i>
                                        </a>
                                    </button>               

                                @else
                                    <div class="d-flex justify-content-center w-50">
                                        <button class="btn food-btns__btn" style="background: var(--color-principal);">
                                            <a href="{{ route('login') }}"
                                                style="text-decoration:none; display:block; color:white;"
                                                class="font-semibold text-dark-600 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                                                <p class="food-btns__p">Comprar</p>
                                            </a>
                                        </button>
                                    </div>
    
                                    <div class="d-flex justify-content-center w-50">
                                        <button class="btn food-btns__btn w-100 d-flex align-items-center justify-content-center">
                                            <a href="{{ route('login') }}" style="text-decoration:none; display:block;"
                                                class="font-semibold focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                                                <i id="foodBtnsCart" class="fa fa-cart-plus food-btns__icon" aria-hidden="true"> Agregar</i>
                                                <i id="foodBtnPlus" class="fa fa-plus" aria-hidden="true"></i>
                                            </a>
                                        </button>
                                    </div>
                                @endauth
                            </div>
                        </div>
    
                    </div>

            @endforeach

        </section>

    </div>

    <div class="alerta" id="alerta"></div>

@endsection

@section('scripts')

    <script>
        $(document).ready(function() {

            $('#cambiar-direccion').click(function(event) {
                Swal.fire({
                    title: 'Actualizar dirección',
                    html: '<div class="d-flex flex-column gap-3 align-items-center justify-content-center p-2">' +
                        '<label class="m-0 p-0 d-flex align-items-center justify-content-start flex-column text-left">Nueva dirección:' +
                        '<input id="campo1" class="swal2-input text-black m-0 mt-2 p-2" placeholder="Ejemplo 123">' +
                        '</label>' +
                        '</div>',

                    focusConfirm: false,
                    showCancelButton: true,
                    confirmButtonColor: '#FC623C',
                    cancelButtonColor: '#0c0c0c',
                    preConfirm: () => {
                        const campo1 = Swal.getPopup().querySelector('#campo1').value;

                        // Validar que los campos no estén vacíos
                        if (!campo1) {
                            Swal.showValidationMessage('Por favor completa todos los campos');
                        }

                        return {
                            campo1: campo1,
                            userId: "{{ auth()->user() ? auth()->user()->id : null }}" // Obtener el ID del usuario autenticado
                        };
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Realizar la petición AJAX para enviar los datos al controlador
                        $.ajax({
                            type: 'POST',
                            url: '{{ route('cliente.actualizar.direccion') }}',
                            data: {
                                nuevaDireccion: result.value.campo1,
                                userId: result.value.userId,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                $('#direccionActual').empty();
                                $('#direccionActual').append(response.nuevaDireccion);
                                Swal.fire({
                                    title: 'Dirección actualizada',
                                    text: '¡Tu dirección ha sido actualizada exitosamente!',
                                    icon: 'success'
                                });
                            },
                            error: function(xhr, status, response) {
                                Swal.fire({
                                    title: 'Error',
                                    text: '¡Hubo un error al actualizar tu dirección!',
                                    icon: 'error'
                                });
                            }
                        });
                    }
                });
            });

            $('#categoria-todo').click(function(event) {
                event.preventDefault();
                $('.foods-section').empty();
                
                $.ajax({
                    url: '{{route('menu.todos')}}',
                    type: 'GET',
                    dataType: 'json',
                    beforeSend: function() {
                        $('.categoria-actual').html("<h4>cargando..</h4>");
                    },
                    success: function(respuesta) {
                        var productosHTML = '';
                        respuesta.forEach(function(producto) {
                            productosHTML += `
                                    <div class="producto-card" id="${producto.nombre}" data-id="${producto.id}" data-nombre="${producto.nombre}" data-precio="${producto.precio}">
                                        <div class="producto-card-img">
                                            <img class="" src="productos/${producto.imagen}" alt="">
                                        </div>

                                        <div class="producto-card-info">
                                            <div class="producto-info-titulo">
                                                <h3 class="producto-titulo__h3">${producto.nombre}</h3>
                                                <span class="producto-titulo__precio">$${producto.precio}</span>
                                            </div>

                                            <div class="food-btns">
                                                @auth
                                                    <form action="{{ route('carrito.buy') }}" id="formAdd_${producto.id}" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="id" id="idProducto_${producto.id}" value="${producto.id}">
                                                        <div class="d-flex justify-content-center">
                                                            <button type="submit" name="submitForm_${producto.id}" class="food-btns__btn btn" style="background: var(--color-principal)">
                                                                <p class="food-btns__p">Comprar</p>
                                                            </button>
                                                        </div>
                                                    </form>
                                                    
                                                    <button type="button" name="submitForm_${producto.id}" id="submitForm"
                                                        class="agregar-carrito p-2 w-50 d-flex align-items-center justify-content-center food-btns__btn btn border-0">
                                                        <a style="text-decoration:none; display:block;"
                                                            class="font-semibold focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                                                            <i id="foodBtnsCart" class="fa fa-cart-plus food-btns__icon" aria-hidden="true"> Agregar</i>
                                                            <i id="foodBtnPlus" class="fa fa-plus" aria-hidden="true"></i>
                                                        </a>
                                                    </button>
                                                @else
                                                    <div class="d-flex justify-content-center">
                                                        <button class="btn food-btns__btn" style="background: var(--color-principal);">
                                                            <a href="{{ route('login') }}" style="text-decoration:none; display:block; color:white;" class="font-semibold text-dark-600 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                                                                <p class="food-btns__p">Comprar</p>
                                                            </a>
                                                        </button>
                                                    </div>

                                                    <div class="d-flex justify-content-center w-50">
                                                        <button class="btn food-btns__btn w-100 d-flex align-items-center justify-content-center">
                                                            <a href="{{ route('login') }}" style="text-decoration:none; display:block;" class="font-semibold focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                                                                <i id="foodBtnsCart" class="fa fa-cart-plus food-btns__icon" aria-hidden="true"> Agregar</i>
                                                                <i id="foodBtnPlus" class="fa fa-plus" aria-hidden="true"></i>
                                                            </a>
                                                        </button>
                                                    </div>
                                                @endauth
                                            </div>
                                        </div>
                                    </div>`;
                        });
                        $('.foods-section').append(productosHTML);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error en la petición AJAX:', error);
                        // Puedes mostrar un mensaje de error o realizar alguna otra acción de manejo de errores aquí
                    }
                });
            });

            $('.categories-box').click(function(event) {
                event.preventDefault();
                var categoriaId = $(this).data('id');
                var categoriaNombre = $(this).data('nombre');
                
                $('.foods-section').empty();
                $('.categoria-actual').empty();

                categoriaNombre = (typeof categoriaNombre !== 'undefined') ? categoriaNombre : "Ver todo";
                
                $.ajax({
                    url: '{{ url('productos/categoria/') }}/' + categoriaId,
                    type: 'GET',
                    dataType: 'json',
                    beforeSend: function() {
                        $('.categoria-actual').html("<h4>cargando..</h4>");
                    },
                    success: function(respuesta) {
                        var productosHTML = '';
                        $('.categoria-actual').empty();
                        // if (categoriaNombre == ""){
                        //     categoriaNombre = "Ver todo";
                        // }
                        var catNombre = `<h2>${categoriaNombre}</h2>`
                        respuesta.forEach(function(producto) {
                            productosHTML += `
                                    <div class="producto-card" id="${producto.nombre}" data-id="${producto.id}" data-nombre="${producto.nombre}" data-precio="${producto.precio}">
                                        <div class="producto-card-img">
                                            <img class="" src="productos/${producto.imagen}" alt="">
                                        </div>

                                        <div class="producto-card-info">
                                            <div class="producto-info-titulo">
                                                <h3 class="producto-titulo__h3">${producto.nombre}</h3>
                                                <span class="producto-titulo__precio">$${producto.precio}</span>
                                            </div>

                                            <div class="food-btns">
                                                @auth
                                                    <form action="{{ route('carrito.buy') }}" id="formAdd_${producto.id}" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="id" id="idProducto_${producto.id}" value="${producto.id}">
                                                        <div class="d-flex justify-content-center">
                                                            <button type="submit" name="submitForm_${producto.id}" class="food-btns__btn btn" style="background: var(--color-principal)">
                                                                <p class="food-btns__p">Comprar</p>
                                                            </button>
                                                        </div>
                                                    </form>
                                                    
                                                    <button type="button" name="submitForm_${producto.id}" id="submitForm"
                                                        class="agregar-carrito p-2 w-50 d-flex align-items-center justify-content-center food-btns__btn btn border-0">
                                                        <a style="text-decoration:none; display:block;"
                                                            class="font-semibold focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                                                            <i id="foodBtnsCart" class="fa fa-cart-plus food-btns__icon" aria-hidden="true"> Agregar</i>
                                                            <i id="foodBtnPlus" class="fa fa-plus" aria-hidden="true"></i>
                                                        </a>
                                                    </button>
                                                @else
                                                    <div class="d-flex justify-content-center">
                                                        <button class="btn food-btns__btn" style="background: var(--color-principal);">
                                                            <a href="{{ route('login') }}" style="text-decoration:none; display:block; color:white;" class="font-semibold text-dark-600 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                                                                <p class="food-btns__p">Comprar</p>
                                                            </a>
                                                        </button>
                                                    </div>

                                                    <div class="d-flex justify-content-center w-50">
                                                        <button class="btn food-btns__btn w-100 d-flex align-items-center justify-content-center">
                                                            <a href="{{ route('login') }}" style="text-decoration:none; display:block;" class="font-semibold focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                                                                <i id="foodBtnsCart" class="fa fa-cart-plus food-btns__icon" aria-hidden="true"> Agregar</i>
                                                                <i id="foodBtnPlus" class="fa fa-plus" aria-hidden="true"></i>
                                                            </a>
                                                        </button>
                                                    </div>
                                                @endauth
                                            </div>
                                        </div>
                                    </div>`;
                        });
                        $('#foods-section').append(productosHTML);
                        $('.categoria-actual').append(catNombre);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error en la petición AJAX:', error);
                        // Manejar errores de manera apropiada
                    }
                });
            });

        });
    </script>

    

    <script>
        $(document).on('click', '.agregar-carrito', function() {
        var $productoCard = $(this).closest('.producto-card');
        var id = $productoCard.data('id');
        var nombre = $productoCard.data('nombre');
        var precio = $productoCard.data('precio');

    // Función para mostrar la alerta
    function mostrarAlerta(nombre) {
        Toastify({
            text:  '+1 '+nombre,
            duration: 3000,
            destination: "/carrito/checkout", // Reemplaza esto con la ruta correcta
            newWindow: true,
            close: true,
            gravity: "bottom",
            position: "right",
            stopOnFocus: true,
            style: {
                background: "#fc623c",
            },
            offset: {
                x: 0,
                y: 100
            },
        }).showToast();
    }

    $.ajax({
        url: '{{ route('carrito.add') }}',
        type: 'POST',
        data: {
            id: id,
            nombre: nombre,
            precio: precio,
            _token: '{{ csrf_token() }}'
        },
        success: function(respuesta) {
            $('#cantidadCarrito, #cantidadCarrito2').text(respuesta.cantidad);
            mostrarAlerta(nombre);
        }
    });
});

    </script>

    <script src="{{ asset('/js/jquery.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('/js/slick.js') }}"></script>
    <script src="{{ asset('/js/slick.min.js') }}"></script>
@endsection
