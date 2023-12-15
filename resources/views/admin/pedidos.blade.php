@extends('adminlte::page')

@section('title', 'Lista de pedidos')

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="{{ asset('/css/index.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/responsive.css') }}" rel="stylesheet">
@stop

@section('content_header')
    <h2>Lista de pedidos pendientes</h2>
@stop

@section('content')

        @if (session('success'))
            <div class="alert alert-success w-75 mb-2 text-center m-auto d-flex justify-content-center alert-block">
                <strong>{{ session('success') }}</strong>
            </div>
        @endif

            <table id="example" class="table bd-danger table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Telefono</th>
                        <th>Direccion</th>
                        <th class="text-center">Pedido</th>
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
                            <td class="d-flex align-items-center justify-content-center"><button type="btn" class="btn btn-dark" onclick="asd();"><i class="fa fa-eye" aria-hidden="true"></i></button></td>
                            <td>{{ $pedido->metodo_de_pago }}</td>
                            <td><span class="bg-primary rounded p-1">{{ $pedido->envio }}</span></td>
                            <td>{{ $pedido->total }}</td>
                            <td>{{ $pedido->create_time }}</td>
                            <td>
                                <a href="pedidos/{{ $pedido->id }}/delete" class="btn btn-success">Entregado</a>
                            </td>
                        </tr>
                        <script>
                            function asd() {
                                return Swal.fire({
                                title: 'Detalles del pedido' ,
                                html: `
                                    <b>Direccion de envio: </b>{{$pedido->direccion}}<br></br>
                                    <b>Metodo de pago: </b> {{$pedido->metodo_de_pago}}<br></br>
                                    <b>Envío: </b> {{$pedido->envio}}<br></br>
                                    <b>Total a pagar: </b> {{$pedido->total}}<br></br>
                                    <b>Pedido: </b> {{$pedido->pedido}}
                                `,
                                });
                            }
                        </script>
                    @endforeach
                </tbody>
            </table>

@stop

@section('js')


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
