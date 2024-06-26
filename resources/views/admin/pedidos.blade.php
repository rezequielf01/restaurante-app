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
            <img class="admin-title-header__img" src="../images/pedidos.png" alt="Pedido png">
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

            <table id="example" class="table table-striped" style="width:100%">
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
                            <td style="width: 15%"><a href="https://wa.me/{{$pedido->telefono}}" target="_blank" title="Abrir chat" style="background:rgb(86, 218, 86); color: white; border-radius: 3px" class="p-1 text-decoration-none"><i class="fa fa-whatsapp" aria-hidden="true"></i> {{ $pedido->telefono }}</a></td>
                            <td style="width: 15%">{{ $pedido->direccion }}</td>
                            {{-- <td style="width: 10%"><span class="bg-primary rounded p-1">{{ $pedido->envio }}</span></td> --}}
                            <td style="width: 15%">{{ $pedido->envio }}</td>
                            <td style="width: 15%">{{ $pedido->total }}</td>
                            <td style="width: 15%">{{ $pedido->create_time }}</td>
                            <td id="td-acciones" style="width: 15%">
                                <a href="pedidos/{{ $pedido->id }}/entregado" title="Entregado" style="color: white; background: rgb(86, 218, 86); box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);" class="btn">
                                    <i class="fa fa-check" aria-hidden="true"></i>
                                </a>
                                <a href="pedidos/{{ $pedido->id }}/cancelado" title="Cancelado" style="color: white; background: rgb(253, 63, 63); box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);" class="btn">
                                    <i class="fa fa-ban" aria-hidden="true"></i>
                                </a>
                                <a href="ticket/{{$pedido->id}}" target="_blank" title="Imprimir factura" style="color: white; background: rgb(33, 118, 255); box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);" class="btn">
                                    <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

@stop

@section('js')

    <script src="https://kit.fontawesome.com/18e24e909e.js" crossorigin="anonymous"></script>       
    <script>
        $('#example').dataTable({
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
    </script>
@stop
