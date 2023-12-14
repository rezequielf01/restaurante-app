<!DOCTYPE html>
<html lang="es">

<head>

    @yield('css')
    {{-- METAS --}}
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- STYLE SHEETS --}}
    <link href="{{ asset('/css/index.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/responsive.css') }}" rel="stylesheet">
    {{-- SLICK SLIDER --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/slick.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/slick-theme.css') }}" />
    {{-- bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    {{-- ICONS --}}

    {{-- GOOGLE FONTS --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Domine&family=Satisfy&display=swap" rel="stylesheet">

    {{-- TITLE --}}
    <title>@yield('title')</title>

</head>

<body class="body">

    <div id="preloader">
        <img src="{{ asset('/images/preloader.png') }}" class="preloader__img animacion-rotacion" alt="">
    </div>

    {{-- HEADER --}}
    <header class="header">


        <a href="{{ route('home') }}" class="header__logo">
            <img src="https://www.raicescocinacasera.com.ar/site/wp-content/uploads/2020/01/logo-raices.png"
                class="header__logo-img" alt="">
        </a>

        <div class="header-nav dropdown">

            <a href="{{ route('carrito.checkout') }}" class="cart m-2" style="text-decoration: none">
                <i class="carrito__icon fa fa-shopping-cart text-danger" aria-hidden="true"></i>
                <span class="card__count" style="color:white;">{{ Cart::count() }}</span>
            </a>

            <button class="btn dropdown-toggle d-flex flex-row align-items-center"
                style="color: var(--color-principal);" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                aria-expanded="false">
                @auth
                    @php
                        $userName = auth()->user()->name;
                        $userDireccion = auth()->user()->direccion;
                    @endphp
                    <div class="container d-flex" style="flex-direction:column;">
                        <span class="text-light" style="font-size: .9rem">
                            <i class="fa fa-map-marker text-danger" aria-hidden="true"></i>
                            {{ ucfirst($userDireccion) }}
                        </span>
                    </div>
                @else
                    <i class="fa fa-user text-danger" aria-hidden="true"></i>
                @endauth
            </button>
            <ul class="dropdown-menu mt-2 pe-2 text-center" style="background: #0c0c0c;"
                aria-labelledby="dropdownMenuButton1">
                @if (Route::has('login'))
                    <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10 ">
                        @auth
                            <div class="d-flex flex-column text-start ms-2" style="gap: 10px">
                                <span style="font-size: .9rem" class="text-light text-center">
                                    {{ ucfirst($userName) }}
                                </span>

                                {{-- <a href="{{ route('usuario.perfil') }}" class="text-light" style="text-decoration: none">
                                    <i style="color:rgb(252, 98, 60);" class="fa fa-cog" aria-hidden="true"></i>
                                    Ajustes de cuenta
                                </a> --}}

                                {{-- MIS PEDIDOS --}}
                                {{-- <a href="{{route("usuario.pedidos")}}" class="text-light" style="text-decoration: none">
                                    <i style="color:rgb(252, 98, 60);" class="fa fa-shopping-bag" aria-hidden="true"></i>
                                    Mis pedidos
                                </a> --}}

                                <a class="text-light" style="text-decoration: none;" href="javascript:void"
                                    onclick="$('#logout-form').submit();">
                                    <i class="fa fa-sign-out text-danger" aria-hidden="true"></i>
                                    Cerrar sesion
                                </a>
                            </div>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @else
                            <li class="mb-2 py-2 bg-danger">

                                <a href="{{ route('login') }}" style="text-decoration:none; display:block; color:black;"
                                    class="font-semibold text-dark-600 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Loguearse</a>

                            </li>
                            <li>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}"
                                        style="color: #f1f1f1; display:block; text-decoration:none"
                                        class="ml-4 font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Registrarse</a>
                                @endif
                            </li>
                        @endauth
                    </div>
                @endif
            </ul>
        </div>


    </header>

    {{-- CONTENIDO PRINCIPAL --}}
    @yield('contenido')

    {{-- FOOTER --}}
    <footer class="footer">
        <p>Copyright © 2019 · Raíces</p>
    </footer>

    {{-- SCRIPTS --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js"
        integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @yield('scripts')
    <script src="https://kit.fontawesome.com/18e24e909e.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('/js/index.js') }}"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    @yield('js')
</body>

</html>
