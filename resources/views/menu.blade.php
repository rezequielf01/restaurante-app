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
        <a href="{{ route('carrito.checkout') }}"
            class="cart d-flex flex-column justify-content-center align-items-center text-decoration-none text-danger">
            <div class="m-0 p-0">
                <i class="carrito__icon fa fa-shopping-cart"
                    aria-hidden="true"></i>
                <span class="card__count" style="color:white;">{{ Cart::count() }}</span>
            </div>
            <span class="nm-mobile__span m-0">Carrito</span>
        </a>
        <a href="{{ route('menu') }}"
            class="d-flex text-danger text-decoration-none flex-column justify-content-center align-items-center">
            <i class="fa fa-book nm-icons" aria-hidden="true"></i>
            <span class="nm-mobile__span">Menú</span>
        </a>
        <div class="btn-group d-flex dropup">
            <button type="button" class="d-flex bg-transparent border-0 dropdown-toggle" data-bs-toggle="dropdown"
                aria-expanded="false">
                <span class="d-flex text-danger text-decoration-none flex-column justify-content-center align-items-center"
                    style="font-size: .9rem">
                    <i class="fa fa-user text-danger nm-icons" aria-hidden="true"></i>
                    <span class="nm-mobile__span m-0">Perfil <i class="fa fa-level-up" aria-hidden="true"></i></span>
                </span>
            </button>
            <ul class="dropdown-menu m-0 p-0 border-1">
                <div
                    class="card d-flex flex-column p-3 bg-light shadow-lg border-0 align-items-center justify-content-center">
                    @auth
                        @php
                            $userName = auth()->user()->name;
                            $userDireccion = auth()->user()->direccion;
                        @endphp
                        <div class="card-title d-flex align-items-center justify-content-center gap-2">
                            <i class="fa fa-user" style="color: var(--color-principal)" aria-hidden="true"></i>
                            {{ ucfirst($userName) }}
                        </div>
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex align-items-center justify-content-center gap-2">
                                <i class="fa fa-map-marker" style="color: var(--color-principal);" aria-hidden="true"></i>
                                {{ ucfirst($userDireccion) }}
                            </div>
                        </div>
                        <div class="card-footer">
                            <a class="text-black" style="text-decoration: none;" href="javascript:void"
                                onclick="$('#logout-form').submit();">
                                <i class="fa fa-sign-out" style="color: var(--color-principal);" aria-hidden="true"></i>
                                Cerrar sesion
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    @else
                        <li class="mb-3 py-2 bg-danger p-3">

                            <a href="{{ route('login') }}" style="text-decoration:none; display:block; color:black;"
                                class="font-semibold text-dark-600 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Ingresar</a>

                        </li>
                        <p>o</p>
                        <li>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    style="color: white; background:#0c0c0c; display:block; text-decoration:none"
                                    class="ml-4 p-2 font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Registrarse</a>
                            @endif
                        </li>
                    @endauth
                </div>
            </ul>
        </div>
        {{-- <button class="btn dropdown-toggle d-flex flex-row align-items-center" style="color: var(--color-principal);"
            type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
            @auth
                @php
                    $userName = auth()->user()->name;
                    $userDireccion = auth()->user()->direccion;
                @endphp
                <div class="container d-flex" style="flex-direction:column;">
                    <span class="text-light" style="font-size: .9rem">
                        <i style="color:rgb(252, 98, 60);" class="fa fa-map-marker" aria-hidden="true"></i>
                        {{ ucfirst($userDireccion) }}
                    </span>
                </div>
            @else
                <i class="fa fa-user" aria-hidden="true"></i>
            @endauth
        </button> --}}
    </nav>

    <div class="contenedor-principal">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img style="height: 500px"
                        src="https://www.guiarepsol.com/content/dam/repsol-guia/contenidos-imagenes/comer/nuestros-favoritos/restaurante-raices-talavera-de-la-reina/gr-cms-media-featured_images-none-5d1f48f5-d145-41d6-a151-52623884d1b4-raices_445s.jpg"
                        class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img style="height: 500px"
                        src="https://www.raicescocinacasera.com.ar/site/wp-content/uploads/2013/12/home-1.jpg"
                        class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Siguiente</span>
            </button>
        </div>

        <div class="categories">
            <a href="#burguer" class="categories-box">
                <img class="categories-box__img" src="images/hamburguesa.png" alt="">
                <span class="categories-box__p">Burguer</span>
            </a>
            <a href="#pizza" class="categories-box">
                <img class="categories-box__img" src="images/pizza.png" alt="">
                <span class="categories-box__p">Pizza</span>
            </a>
            <a href="#bebidas" class="categories-box">
                <img class="categories-box__img" src="images/bebidas.png" alt="">
                <span class="categories-box__p">Bebidas</span>
            </a>
        </div>

        <section class="foods-section">

            @if (session('success'))
                <script>
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Your work has been saved",
                        showConfirmButton: false,
                        timer: 1500
                    });
                </script>
            @endif

            <div class="food-list" id="burguer">

                <div class="food-list-title">
                    <div class="shadow-lg" style="background: var(--color-principal); padding: 7px; border-radius: 50%;">
                        <img class="food-list__icon" src="images/hamburguesa.png" alt="">
                    </div>
                    <h2 class="food-list__h2">Hamburguesas</h2>
                </div>

                <div class="food-carousel">

                    @foreach ($hamburgesas as $hamburgesa)
                        <div class="food-wrapp p-3 shadow-none">
                            <div class="food-card">
                                <div class="food-img">
                                    <span class="food__precio">
                                        @php
                                         echo "$".number_format($hamburgesa->precio,0,'.',',');   
                                        @endphp
                                    </span>
                                    <img src="productos/{{ $hamburgesa->imagen }}" alt="{{ $hamburgesa->nombre }}" class="food__img">
                                </div>
                                <div class="food-description">
                                    <h2 class="food-description__h2">{{ $hamburgesa->nombre }}</h2>
                                    <p class="food-description__p mb-0 w-100 text-left">{{ $hamburgesa->descripcion }}</p>
                                </div>
                                <div class="food-btns">
                                    @auth
                                        {{-- COMPRAR --}}
                                        <form action="{{ route('carrito.buy') }}" id="formAdd" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="id" id="id"
                                                value="{{ $hamburgesa->id }}">
                                            <div class="d-flex justify-content-center">
                                                <button type="submit" name="submitForm" id="submitForm"
                                                    class="food-btns__btn btn" style="background: var(--color-principal)"><p class="food-btns__p">Comprar</p>
                                                </button>
                                            </div>
                                        </form>

                                        {{-- AGREGAR AL CARRITO --}}
                                        <form action="{{ route('carrito.add') }}" id="formAdd" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="id" id="id"
                                                value="{{ $hamburgesa->id }}">
                                            <div class="d-flex justify-content-center">
                                                <button type="submit" name="submitForm" id="submitForm"
                                                    class="food-btns__btn btn" style="background: #0c0c0c;"><i class="fa fa-cart-plus food-btns__icon"
                                                        aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </form>

                                        @else
                                        <div class="d-flex justify-content-center">
                                            <button class="btn food-btns__btn" style="background: var(--color-principal);">
                                                <a href="{{ route('login') }}"
                                                    style="text-decoration:none; display:block; color:white;"
                                                    class="font-semibold text-dark-600 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"><p class="food-btns__p">Comprar</p></a>
                                            </button>
                                        </div>

                                        <div class="d-flex justify-content-center">
                                            <button class="btn food-btns__btn" style="background: #0c0c0c">
                                                <a href="{{ route('login') }}"
                                                    style="text-decoration:none; display:block;"
                                                    class="font-semibold focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"><i
                                                        class="fa fa-cart-plus food-btns__icon" aria-hidden="true"></i></a>
                                            </button>
                                        </div>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>

            <div class="food-list" id="bebidas">

                <div class="food-list-title">
                    <div class="shadow-lg" style="background: var(--color-principal); padding: 5px; border-radius: 50%;">
                        <img class="food-list__icon" src="images/bebidas.png" alt="">
                    </div>
                    <h2 class="food-list__h2">Bebidas</h2>
                </div>

                <div class="food-carousel">

                    @foreach ($bebidas as $bebida)
                        <div class="food-wrapp p-3 shadow-none">
                            <div class="food-card">
                                <div class="food-img">
                                    <span class="food__precio">
                                        @php
                                         echo "$".number_format($bebida->precio,0,'.',',');   
                                        @endphp
                                    </span>
                                    <img src="productos/{{ $bebida->imagen }}" alt="{{ $bebida->nombre }}" class="food__img">
                                </div>
                                <div class="food-description">
                                    <h2 class="food-description__h2">{{ $bebida->nombre }}</h2>
                                    <p class="food-description__p mb-0 w-100 text-left">{{ $bebida->descripcion }}</p>
                                </div>
                                <div class="food-btns">
                                    @auth
                                        {{-- COMPRAR --}}
                                        <form action="{{ route('carrito.buy') }}" id="formAdd" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="id" id="id"
                                                value="{{ $bebida->id }}">
                                            <div class="d-flex justify-content-center">
                                                <button type="submit" name="submitForm" id="submitForm"
                                                    class="food-btns__btn btn" style="background: var(--color-principal)"><p class="food-btns__p">Comprar</p>
                                                </button>
                                            </div>
                                        </form>

                                        {{-- AGREGAR AL CARRITO --}}
                                        <form action="{{ route('carrito.add') }}" id="formAdd" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="id" id="id"
                                                value="{{ $bebida->id }}">
                                            <div class="d-flex justify-content-center">
                                                <button type="submit" name="submitForm" id="submitForm"
                                                    class="food-btns__btn btn" style="background: #0c0c0c;"><i class="fa fa-cart-plus food-btns__icon"
                                                        aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </form>

                                        @else
                                        <div class="d-flex justify-content-center">
                                            <button class="btn food-btns__btn" style="background: var(--color-principal);">
                                                <a href="{{ route('login') }}"
                                                    style="text-decoration:none; display:block; color:white;"
                                                    class="font-semibold text-dark-600 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"><p class="food-btns__p">Comprar</p></a>
                                            </button>
                                        </div>

                                        <div class="d-flex justify-content-center">
                                            <button class="btn food-btns__btn" style="background: #0c0c0c">
                                                <a href="{{ route('login') }}"
                                                    style="text-decoration:none; display:block;"
                                                    class="font-semibold focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"><i
                                                        class="fa fa-cart-plus food-btns__icon" aria-hidden="true"></i></a>
                                            </button>
                                        </div>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>

        </section>
    </div>

@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('/js/jquery.js') }}"></script>
    <script src="{{ asset('/js/slick.js') }}"></script>
    <script src="{{ asset('/js/slick.min.js') }}"></script>
@endsection
