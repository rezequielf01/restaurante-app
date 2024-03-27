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
    <link href="{{ asset('/css/dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/responsive.css') }}" rel="stylesheet">
    {{-- SLICK SLIDER --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/slick.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/slick-theme.css') }}" />
    {{-- bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    {{-- ICONS --}}

    {{-- ALERTS --}}
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    {{-- TOASTIFY - NOTIFICACIONES --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    {{-- GOOGLE FONTS --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@100..900&display=swap" rel="stylesheet">

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

        <a href="#" class="header-btn-wsp">
            <i class="fa fa-whatsapp float-btn-wsp__icon"></i>
        </a>

        <div class="header-nav dropdown">

            <div class="darkmode-container">
                <i class="fa fa-moon-o darkmode-i__moon" aria-hidden="true"></i>
                <i class="fa fa-sun-o darkmode-i__sun" aria-hidden="true"></i>
            </div>

            <button id="dark-mode-toggle">Modo Oscuro</button>

            <a href="{{ route('carrito.checkout') }}" class="cart m-2" style="text-decoration: none">
                <i class="carrito__icon fa fa-shopping-cart" style="color: var(--color-principal)" aria-hidden="true"></i>
                <span id="cantidadCarrito" data-id="{{ Cart::count() }}" class="card__count" style="color:white;">{{ Cart::count() }}</span>
            </a>

            <div class="user-container d-flex">

                @auth
                    @php
                        $userName = auth()->user()->name;
                        $userDireccion = auth()->user()->direccion;
                    @endphp

                    <div>

                        <div class="dropdown">
                            <button class="btn dropdown-toggle d-flex align-items-center justify-content-center" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">

                                <div class="container d-flex" style="flex-direction:column;">
                                    <span class="text-light d-flex align-items-center justify-content-center" style="font-size: .9rem">
                                        <div class="d-flex flex-column align-items-center justify-content-center">
                                            <p class="m-0"><i class="fa fa-map-marker" style="color: var(--color-principal)" aria-hidden="true"></i> Enviar a</p>
                                            <span class="m-0" id="direccionActual">{{ ucfirst($userDireccion) }}</span>
                                        </div>
                                    </span>
                                </div>

                            </button>

                            <ul class="dropdown-menu p-0" style="min-width: 180px; background: linear-gradient(to right, black, #0c0c0c);" aria-labelledby="dropdownMenuButton1">

                                <li class="dropdown-menu__link">
                                    <a href="#" id="cambiar-direccion" class="d-block p-2" style="text-decoration: none; font-size: 1rem">
                                        <i class="fa fa-map-marker" style="color: var(--color-principal)" aria-hidden="true"></i>
                                        Cambiar dirección
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
                    <div class="d-flex gap-2" style="color: #5c5c5c">
                        <a href="login" class="user-p">Ingresar </a>
                        /
                        <a href="register" class="user-p"> Registrarse</a>
                    </div>
                @endauth
                
            </div>

        </div>


    </header>

    {{-- CONTENIDO PRINCIPAL --}}
    @yield('contenido')

    {{-- FOOTER --}}
    <footer class="footer">
        <p>Copyright © 2019 · Raíces</p>
    </footer>

    {{-- SCRIPTS --}}
    <script>
        document.getElementById('dark-mode-toggle').addEventListener('click', function() {   
            document.body.classList.toggle("dark-mode");
    
            // Definir la variable cards dentro de la función de clic del botón
            let cards = document.querySelectorAll(".producto-card");
    
            cards.forEach(function(card) {
                card.classList.toggle("dark-mode");
    
                // Agregar estilos específicos a la tarjeta actual
                if (document.body.classList.contains("dark-mode")) {
                    // Si está en modo oscuro, agregar estilos para modo oscuro a la tarjeta de producto
                    card.style.backgroundColor = "#0c0c0c"; 
                    card.style.color = "#9c9c9c"; 
                    card.style.border = "solid 1px #1c1c1c"; 
                } else {
                    // Si está en modo claro, agregar estilos para modo claro a la tarjeta de producto
                    card.style.backgroundColor = "white"; // Cambiar el color de fondo a blanco
                    card.style.color = "black"; // Cambiar el color del texto a un tono oscuro
                    card.style.border = "solid 1px transparent"; 
                }
            });
    
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js"
        integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    
    @yield('scripts')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://kit.fontawesome.com/18e24e909e.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="{{ asset('/js/index.js') }}"></script>
    @yield('js')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
</body>

</html>
