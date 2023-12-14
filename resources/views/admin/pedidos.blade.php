@extends('adminlte::page')

@section('title', 'Lista de pedidos')

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="{{ asset('/css/index.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/responsive.css') }}" rel="stylesheet">
@stop

@section('content_header')
    
@stop

@section('content')

<div class="table-container container h-100 d-flex justify-content-center align-items-center">
    @if(session('success'))
    <div class="alert alert-success w-75 mb-2 text-center m-auto d-flex justify-content-center alert-block">
        <strong >{{session('success')}}</strong>
    </div>
@endif
<div class="card-table-container container w-100 bg-light shadow-lg mb-5 bg-body rounded p-3" style="border-radius: 5px; position: relative;" >
    
    <div class="table-icon shadow-lg">
        <img style="width: 100%" src="{{ asset('/images/pedidos.png') }}" alt="">
    </div>
    
        <table id="example" class="table bd-danger table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Telefono</th>
                    <th>Direccion</th>
                    <th>Pedido</th>
                    <th>Forma de pago</th>
                    <th>Envio</th>
                    <th>Total</th>
                    <th>Fecha y hora</th>
                    <th>Accion</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pedidos as $pedido)
                    <tr>
                        <td style="width: 120px">{{ $pedido->cliente }}</td>
                        <td>{{ $pedido->telefono }}</td>
                        <td>{{ $pedido->direccion }}</td>
                        <td style="width: 800px">{{ $pedido->pedido }}</td>
                        <td>{{ $pedido->metodo_de_pago }}</td>
                        <td>{{ $pedido->envio }}</td>
                        <td>{{ $pedido->total }}</td>
                        <td>{{ $pedido->create_time }}</td>
                        <td>
                            <a href="pedidos/{{$pedido->id}}/delete" class="btn btn-primary">Entregado</a></div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
</div>
</div>

@stop

@section('js')
    <script>
        $('#example').dataTable( {
            responsive: true,
            language: {
        processing:     "Traitement en cours...",
        search:         "Buscar",
        lengthMenu:    "Mostrar _MENU_ entradas",
        info:           "Pagina _START_ de _END_ de _TOTAL_ entradas",
        infoEmpty:      "Mostrando 0 de 0 de 0 entradas",
        infoFiltered:   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
        infoPostFix:    "",
        loadingRecords: "Chargement en cours...",
        zeroRecords:    "Aucun &eacute;l&eacute;ment &agrave; afficher",
        emptyTable:     "No se registraron pedidos hasta el momento",
        paginate: {
            first:      "Premier",
            previous:   "Anterior",
            next:       "Siguiente",
            last:       "Dernier"
        },
        aria: {
            sortAscending:  ": activer pour trier la colonne par ordre croissant",
            sortDescending: ": activer pour trier la colonne par ordre décroissant"
        }
    }
        } );
    </script>
@stop


