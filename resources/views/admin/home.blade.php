@extends('adminlte::page')

@section('title', 'Admin panel')

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="{{ asset('/css/index.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/responsive.css') }}" rel="stylesheet">
@stop

@section('content_header')

@stop

@section('content')

    <div class="admin-container">

        <p style="opacity: 0">.</p>

        <div class="admin-header mt-4 mb-3">
            <span class="admin-title-header__span">
                <img class="admin-title-header__img" src="images/dashboard.png" alt="dashboard png">
            </span>
            <h2 class="admin-title-header__h2">Panel de administración</h2>
        </div>

        <div class="d-flex flex-wrap gap-4 align-items-center justify-content-center">

            <div class="small-box shadow-lg" style="width: 300px; background:white; padding: 15px">
                <div class="d-flex align-items-center justify-content-around">
                    <div style="color: black" class="inner">
                        <h3>{{ $usuariosRegistrados }}</h3>
                        <p>Clientes registrados</p>
                    </div>
                    <div style="width:70px; height: 65px" class="card-title d-flex align-items-center justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="22" fill="none" class="text-gs-gray-500 shrink-0 hidden md:inline-flex"><path stroke="currentColor" d="M1 21 14.5 1"></path></svg>
                    </div>
                </div>

                <a href="{{ route('admin.pedidos') }}" class="small-box-footer" style="color: white; background-color: var(--color-principal)">Más informacion <i class="fas fa-arrow-circle-right"></i></a>
            </div>

            <div class="small-box shadow-lg" style="width: 300px; background:white; padding: 15px">
                <div class="d-flex align-items-center justify-content-around">
                    <div style="color: black" class="inner">
                        <h3>{{ $pedidosPendientes }}</h3>
                        <p>Pedidos pendientes</p>
                    </div>
                    <div style="width:70px; height: 65px" class="card-title d-flex align-items-center justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-[#bd1e59]" data-id="16"><circle cx="8" cy="21" r="1"></circle><circle cx="19" cy="21" r="1"></circle><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"></path></svg>
                    </div>
                </div>

                <a href="{{ route('admin.usuarios') }}" class="small-box-footer" style="color: white; background-color: var(--color-principal)">Más informacion <i class="fas fa-arrow-circle-right"></i></a>
            </div>

            <div class="small-box shadow-lg" style="width: 300px; background:white; padding: 15px">
                <div class="d-flex align-items-center justify-content-around">
                    <div style="color: black" class="inner">
                        <h3>{{ $pedidosEntregados }}</h3>
                        <p>Pedidos entregados</p>
                    </div>
                    <div style="width:70px; height: 65px" class="card-title d-flex align-items-center justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-[#bd1e59]" data-id="23"><circle cx="18.5" cy="17.5" r="3.5"></circle><circle cx="5.5" cy="17.5" r="3.5"></circle><circle cx="15" cy="5" r="1"></circle><path d="M12 17.5V14l-3-3 4-3 2 3h2"></path></svg>
                    </div>
                </div>

                <a href="{{ route('admin.pedidos') }}" class="small-box-footer" style="color: white; background-color: var(--color-principal)">Más informacion <i class="fas fa-arrow-circle-right"></i></a>
            </div>

            <div class="small-box shadow-lg" style="width: 300px; background:white; padding: 15px">
                <div class="d-flex align-items-center justify-content-around">
                    <div style="color: black" class="inner">
                        <h3>{{ $ventasEnLocal }}</h3>
                        <p>Ventas en el local</p>
                    </div>
                    <div style="width:70px; height: 65px" class="card-title d-flex align-items-center justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-[#bd1e59]" data-id="30"><path d="m2 7 4.41-4.41A2 2 0 0 1 7.83 2h8.34a2 2 0 0 1 1.42.59L22 7"></path><path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"></path><path d="M15 22v-4a2 2 0 0 0-2-2h-2a2 2 0 0 0-2 2v4"></path><path d="M2 7h20"></path><path d="M22 7v3a2 2 0 0 1-2 2v0a2.7 2.7 0 0 1-1.59-.63.7.7 0 0 0-.82 0A2.7 2.7 0 0 1 16 12a2.7 2.7 0 0 1-1.59-.63.7.7 0 0 0-.82 0A2.7 2.7 0 0 1 12 12a2.7 2.7 0 0 1-1.59-.63.7.7 0 0 0-.82 0A2.7 2.7 0 0 1 8 12a2.7 2.7 0 0 1-1.59-.63.7.7 0 0 0-.82 0A2.7 2.7 0 0 1 4 12v0a2 2 0 0 1-2-2V7"></path></svg>
                    </div>
                </div>

                <a href="{{ route('admin.ventas.local') }}" class="small-box-footer" style="color: white; background-color: var(--color-principal)">Más informacion <i class="fas fa-arrow-circle-right"></i></a>
            </div>
            
            <div class="small-box shadow-lg" style="width: 300px; background:white; padding: 15px">
                <div class="d-flex align-items-center justify-content-around">
                    <div style="color: black" class="inner">
                        <h3>{{ $productosRegistrados }}</h3>
                        <p>Productos totales</p>
                    </div>
                    <div style="width:70px; height: 65px" class="card-title d-flex align-items-center justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-[#bd1e59]" data-id="30"><path d="m2 7 4.41-4.41A2 2 0 0 1 7.83 2h8.34a2 2 0 0 1 1.42.59L22 7"></path><path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"></path><path d="M15 22v-4a2 2 0 0 0-2-2h-2a2 2 0 0 0-2 2v4"></path><path d="M2 7h20"></path><path d="M22 7v3a2 2 0 0 1-2 2v0a2.7 2.7 0 0 1-1.59-.63.7.7 0 0 0-.82 0A2.7 2.7 0 0 1 16 12a2.7 2.7 0 0 1-1.59-.63.7.7 0 0 0-.82 0A2.7 2.7 0 0 1 12 12a2.7 2.7 0 0 1-1.59-.63.7.7 0 0 0-.82 0A2.7 2.7 0 0 1 8 12a2.7 2.7 0 0 1-1.59-.63.7.7 0 0 0-.82 0A2.7 2.7 0 0 1 4 12v0a2 2 0 0 1-2-2V7"></path></svg>
                    </div>
                </div>

                <a href="{{ route('admin.productos') }}" class="small-box-footer" style="color: white; background-color: var(--color-principal)">Más informacion <i class="fas fa-arrow-circle-right"></i></a>
            </div>
            
            <div class="small-box shadow-lg" style="width: 300px; background:white; padding: 15px">
                <div class="d-flex align-items-center justify-content-around">
                    <div style="color: black" class="inner">
                        <h3>${{ $ingresoMensualTotal }}</h3>
                        <p>Ingresos mensuales</p>
                    </div>
                    <div style="width:70px; height: 65px" class="card-title d-flex align-items-center justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-[#bd1e59]" data-id="30"><path d="m2 7 4.41-4.41A2 2 0 0 1 7.83 2h8.34a2 2 0 0 1 1.42.59L22 7"></path><path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"></path><path d="M15 22v-4a2 2 0 0 0-2-2h-2a2 2 0 0 0-2 2v4"></path><path d="M2 7h20"></path><path d="M22 7v3a2 2 0 0 1-2 2v0a2.7 2.7 0 0 1-1.59-.63.7.7 0 0 0-.82 0A2.7 2.7 0 0 1 16 12a2.7 2.7 0 0 1-1.59-.63.7.7 0 0 0-.82 0A2.7 2.7 0 0 1 12 12a2.7 2.7 0 0 1-1.59-.63.7.7 0 0 0-.82 0A2.7 2.7 0 0 1 8 12a2.7 2.7 0 0 1-1.59-.63.7.7 0 0 0-.82 0A2.7 2.7 0 0 1 4 12v0a2 2 0 0 1-2-2V7"></path></svg>
                    </div>
                </div>

                <a href="#" class="small-box-footer" style="color: white; background-color: var(--color-principal)">Más informacion <i class="fas fa-arrow-circle-right"></i></a>
            </div>

        </div>

    </div>


    <div class="admin-header-mesas d-flex align-items-start justify-content-between mt-4 mb-3">
        <h2 class="admin-title-header__h2" style="color: black">Listado de mesas</h2>
        <button id="mostrar-formulario" type="button" class="btn agregar-mesa-btn">Agregar mesa</button>
    </div>


    <div id="mesas-container" class="mesas-container align-items-center d-flex justify-content-center flex-wrap w-100 p-3" style="height: auto">

    </div>

@stop

@section('js')
    <script>
        $(document).ready(function() {

            $('#mostrar-formulario').click(function() {
                Swal.fire({
                    title: 'Ingresa los datos de la mesa',
                    html: '<div class="d-flex flex-column gap-3 align-items-center justify-content-center p-2">' +
                        '<label class="m-0 p-0 d-flex flex-column text-left">Número de mesa:' +
                        '<input id="campo1" class="swal2-input text-black m-0 mt-2 p-2" placeholder="Nro de mesa">' +
                        '</label>' +
                        '<label class="m-0 p-0 d-flex flex-column text-left">Capacidad máxima:' +
                        '<input id="campo2" class="swal2-input text-black m-0 mt-2 p-2" placeholder="Capacidad">' +
                        '</label>' +
                        '</div>',

                    focusConfirm: false,
                    showCancelButton: true,
                    confirmButtonColor: '#0c0c0c',
                    cancelButtonColor: '#dc3545',
                    preConfirm: () => {
                        const campo1 = Swal.getPopup().querySelector('#campo1').value;
                        const campo2 = Swal.getPopup().querySelector('#campo2').value;

                        // Validar que los campos no estén vacíos
                        if (!campo1 || !campo2) {
                            Swal.showValidationMessage('Por favor completa todos los campos');
                        }

                        return {
                            campo1: campo1,
                            campo2: campo2
                        };
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Realizar la petición AJAX para enviar los datos al controlador
                        $.ajax({
                            type: 'POST',
                            url: '{{ route('admin.agregar.mesa.btn') }}',
                            data: {
                                campo1: result.value.campo1,
                                campo2: result.value.campo2,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                Swal.fire({
                                    title: 'Exitoso',
                                    text: response.mensaje,
                                    icon: 'success'
                                });

                                // Realizar la solicitud AJAX para actualizar las mesas después de agregar una nueva
                                updateMesas();
                            },
                            error: function(xhr, status, response) {
                                Swal.fire({
                                    title: 'Error',
                                    text: '¡El número de mesa ya está en uso!',
                                    icon: 'error'
                                });
                            }
                        });
                    }
                });
            });

            // Función para actualizar las mesas después de agregar una nueva
            function updateMesas() {
                $.ajax({
                    url: '{{ route('admin.mesas') }}',
                    type: "GET",
                    datatype: "json",
                    success: function(response) {
                        // Limpiar el contenedor antes de agregar las mesas actualizadas
                        $('#mesas-container').empty();
                        // Agregar las nuevas mesas
                        response.forEach(mesa => {
                            agregarMesa(mesa);
                        });
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }

            // html +=
            //         '<img class="mesa__img" style="filter: invert(0)" src="/restaurante-app/public/images/mesa.png" alt="Mesa icono">';
            //     html += '<span class="mesa__estado d-flex flex-column gap-1 align-items-center justify-content-center">';
            //     html += '<p class="mesa__p text-black">Mesa N°' + mesa.nro_mesa + '</p>';
            //     html += '<i class="fa fa-users bg-blue p-2 rounded" aria-hidden="true"> Max: ' + mesa
            //         .capacidad + '</i>';
            //     html += estadoHtml;
            //     html += '</span>';
            //     html +=
            //         '<button title="Eliminar mesa" class="eliminar-mesa btn p-0 m-0" data-id="' + mesa.id +
            //         '"><i class="fa fa-times-circle shadow-lg text-dark" style="position: absolute; top: 15px; left: 15px; font-size: 20px" aria-hidden="true"></i></button>'; // Agrega el botón de eliminar
            //     html +=
            //         '<a class="bg-dark d-flex gap-1 justify-content-center align-items-center rounded w-100 p-1" href="admin/administrar/mesas/' +
            //         mesa.id + '" style="text-decoration: none; color: white !important"><p class="m-0 p-0">Ir a mesa</p><i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>';

            // Función para agregar una mesa al contenedor
            function agregarMesa(mesa) {
                var estadoHtml = mesa.productos.length > 0 ?
                    '<span style="background: #EF4444; border-radius: 15px" class="pl-2 pr-2 pt-1 pb-1">Ocupado</span>' :
                    '<span style="background: #22C55E; border-radius: 15px" class="pl-2 pr-2 pt-1 pb-1">Disponible</span>';

                var html = `
                <div class="mesa-box bg-white shadow-lg pl-3 pr-3 rounded d-flex align-items-center justify-content-between" id="mesa-box' + mesa.id +'">
                    <div class="d-flex align-items-center jusitify-content-center gap-2">
                        <img class="mesa__img" style="filter: invert(0)" src="/restaurante-app/public/images/mesa.png" alt="Mesa icono">
                        <div>
                            <p class="mesa__p text-black">Mesa N°${mesa.nro_mesa}</p>
                            <p class="text-black mb-1">Max: ${mesa.capacidad}</p>
                            <span>${estadoHtml}</span>
                        </div>
                    </div>
                    <a class="btn adm-mesa-btn" href="admin/administrar/mesas/${mesa.id}"><p class="m-0 p-0">Ir a mesa</p></a>
                    <button title="Eliminar mesa" class="eliminar-mesa btn p-0 m-0" data-id="${mesa.id}"><i class="fa fa-times-circle shadow-lg text-dark" style="position: absolute; top: 15px; left: 15px; font-size: 20px" aria-hidden="true"></i></button>
                </div>
                `;
               
                $('#mesas-container').append(html);
            }

            // Agrega un controlador de eventos para el botón de eliminar
            $(document).on('click', '.eliminar-mesa', function() {
                var mesaId = $(this).data('id');
                mostrarConfirmacionEliminarMesa(mesaId);
            });

            // Función para mostrar una ventana de confirmación antes de eliminar la mesa
            function mostrarConfirmacionEliminarMesa(mesaId) {
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: 'Esta acción no se puede deshacer',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        eliminarMesa(mesaId);
                    }
                });
            }

            // Define una función para manejar la solicitud AJAX de eliminación de la mesa seleccionada
            function eliminarMesa(mesaId) {
                // Realiza una solicitud AJAX para eliminar la mesa con el ID proporcionado
                $.ajax({
                    type: 'POST',
                    url: '{{ route('admin.eliminar.mesa') }}', // Debes definir la ruta correspondiente en tu backend
                    data: {
                        mesa_id: mesaId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // Elimina la mesa del DOM si la eliminación fue exitosa
                        $('#mesa-box' + mesaId).remove();
                        Swal.fire({
                            title: 'Exitoso',
                            text: response.mensaje,
                            icon: 'success'
                        });
                        updateMesas();
                    },
                    error: function(xhr, status, response) {
                        Swal.fire({
                            title: 'Error',
                            text: '¡No se pudo eliminar la mesa!',
                            icon: 'error'
                        });
                    }
                });
            }
            // Realizar la solicitud AJAX al cargar la página
            updateMesas();

        });
    </script>

    <script src="https://kit.fontawesome.com/18e24e909e.js" crossorigin="anonymous"></script>
@endsection
