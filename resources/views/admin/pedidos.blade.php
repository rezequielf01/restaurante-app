@extends('adminlte::page')

@section('title', 'Lista de pedidos')

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="{{ asset('/css/index.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/responsive.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('content_header')
    <div class="admin-header">
        <span class="admin-title-header__span">
            <img class="admin-title-header__img" src="../images/nuevo-pedido.png" alt="Pedido png">
        </span>
        <h2 class="admin-title-header__h2">Pedidos pendientes</h2>
    </div>
@stop

@section('content')

    @if (session('success'))
        <div class="alert alert-success w-75 mb-2 text-center m-auto d-flex justify-content-center alert-block">
            <strong>{{ session('success') }}</strong>
        </div>
    @endif

    <div class="bg-light shadow-lg p-3">
        <table id="tabla-pedidos-pendientes" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th id="th-table">Pedido Nro</th>
                    <th id="th-table">Cliente</th>
                    <th id="th-table">Telefono</th>
                    <th id="th-table">Direccion</th>
                    {{-- <th >Envio</th> --}}
                    <th id="th-table">Envio</th>
                    <th id="th-table">Total</th>
                    <th id="th-table">Fecha y hora</th>
                    <th id="th-table">Accion</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pedidos_clientes as $pedido)
                    <tr>
                        <td style="width: 5%">{{ $pedido->id }}</td>
                        <td style="width: 15%">{{ $pedido->name }}</td>
                        <td style="width: 15%"><a href="https://wa.me/{{ $pedido->telefono }}" target="_blank"
                                title="Abrir chat" style="background:rgb(86, 218, 86); color: white; border-radius: 3px"
                                class="p-1 text-decoration-none"><i class="fa fa-whatsapp" aria-hidden="true"></i>
                                {{ $pedido->telefono }}</a></td>
                        <td style="width: 15%">{{ $pedido->direccion }}</td>
                        <td style="width: 15%">{{ $pedido->envio }}</td>
                        <td style="width: 15%">${{ $pedido->total }}</td>
                        <td style="width: 15%">{{ $pedido->create_time }}</td>
                        <td id="td-acciones" style="width: 15%">
                            <a href="pedidos/{{ $pedido->id }}/entregado" title="Entregado" data-id="{{ $pedido->id }}"
                                style="color: white; background: rgb(86, 218, 86); box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);"
                                class="btn pedido-entregado-btn">
                                <i class="fa fa-check" aria-hidden="true"></i>
                            </a>
                            <a href="pedidos/{{ $pedido->id }}/cancelado" title="Cancelado"
                                style="color: white; background: rgb(253, 63, 63); box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);"
                                class="btn">
                                <i class="fa fa-ban" aria-hidden="true"></i>
                            </a>
                            <a href="ticket/{{ $pedido->id }}" target="_blank" title="Imprimir factura"
                                style="color: white; background: rgb(33, 118, 255); box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);"
                                class="btn">
                                <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="admin-header mt-5 mb-3">
        <span class="admin-title-header__span">
            <img class="admin-title-header__img" src="../images/pedidos-entregados.png" alt="Pedido png">
        </span>
        <h2 class="admin-title-header__h2">Pedidos entregados</h2>
    </div>

    <div class="bg-light shadow-lg p-3">
        <table id="tabla-pedidos-entregados" class="table bd-danger table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Pedido Nro</th>
                    <th>Cliente</th>
                    <th>Telefono</th>
                    <th>Direccion</th>
                    <th>Envio</th>
                    <th>Total</th>
                    <th>Fecha y hora</th>
                    <th>Accion</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pedidos_clientes_entregado as $pedido)
                    <tr style="background: none; max-height: 50px">
                        <td style="width: 5%">{{ $pedido->id }}</td>
                        <td style="width: 15%">{{ $pedido->name }}</td>
                        <td style="width: 15%"><a href="https://wa.me/{{ $pedido->telefono }}" target="_blank"
                                title="Abrir chat" style="background:rgb(86, 218, 86); color: white; border-radius: 3px"
                                class="p-1 text-decoration-none"><i class="fa fa-whatsapp" aria-hidden="true"></i>
                                {{ $pedido->telefono }}</a></td>
                        <td style="width: 15%">{{ $pedido->direccion }}</td>
                        <td style="width: 15%">{{ $pedido->envio }}</td>
                        <td style="width: 15%">${{ $pedido->total }}</td>
                        <td style="width: 15%">{{ $pedido->create_time }}</td>
                        <td style="width: 15%">
                            <a href="ticket/nro/{{ $pedido->id }}" target="_blank" title="Imprimir factura"
                                style="color: white; background: rgb(33, 118, 255); box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);"
                                class="btn">
                                <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@stop

@section('js')

    <script src="https://kit.fontawesome.com/18e24e909e.js" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {

            var tablaPedidosPendientes = $('#tabla-pedidos-pendientes').DataTable({
                responsive: true,
                language: {
                    processing: "Traitement en cours...",
                    search: "Buscar",
                    lengthMenu: "Mostrar _MENU_ entradas",
                    info: "Pagina _START_ de _END_ de _TOTAL_ entradas",
                    infoEmpty: "Mostrando 0 de 0 de 0 entradas",
                    infoFiltered: "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                    infoPostFix: "",
                    loadingRecords: "Chargement en cours...",
                    zeroRecords: "No se encontraron resultados.",
                    emptyTable: "No se registraron pedidos hasta el momento",
                    paginate: {
                        first: "Premier",
                        previous: "Anterior",
                        next: "Siguiente",
                        last: "Dernier"
                    },
                    aria: {
                        sortAscending: ": activer pour trier la colonne par ordre croissant",
                        sortDescending: ": activer pour trier la colonne par ordre décroissant"
                    }
                }
            });

            // Función para cargar los datos de la tabla
            function recargarTabla() {
                $.ajax({
                    url: "{{ route('admin.pedidos') }}",
                    type: "GET",
                    success: function(response) {
                        tablaPedidosPendientes.clear().draw(); // Limpiar y dibujar la tabla

                        if (response.length > 0) {
                            response.forEach(function(pedido) {
                                tablaPedidosPendientes.row.add([
                                    pedido.id,
                                    pedido.name,
                                    pedido.telefono,
                                    pedido.direccion,
                                    pedido.envio,
                                    '$' + pedido.total,
                                ]).draw(false); // Agregar fila y dibujarla
                            });
                        } else {

                            tablaPedidosPendientes.clear().draw();
                            tablaPedidosPendientes.draw();

                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        // Manejar el error aquí
                    }
                });
            }

            $(document).on('click', '.pedido-entregado-btn', function(event) {
                event.preventDefault(); // Evitar la acción predeterminada del enlace
                
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                var pedidoId = $(this).data('id');
                var fila = $(this).closest('tr'); // Obtener la fila actual del producto

                // Realizar la petición AJAX para marcar el pedido como entregado
                $.ajax({
                    url: '{{ route('admin.pedido.entregado', ['id' => ':pedidoId']) }}'.replace(':pedidoId', pedidoId),
                    method: 'POST', // Cambiar a POST
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(response) {
                        // Si la solicitud es exitosa, mostrar el mensaje de éxito y actualizar la tabla si es necesario
                        Swal.fire('Éxito', response.message, 'success');
                        recargarTabla(); // Esto debería ser una función definida previamente que actualiza la tabla
                    },
                    error: function(xhr, status, error) {
                        // Manejar los errores
                        Swal.fire('Error', 'Hubo un problema al entregar el pedido.', 'error');
                    }
                });
            });

        });
    </script>

@stop
