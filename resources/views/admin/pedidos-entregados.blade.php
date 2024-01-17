@extends('adminlte::page')

@section('title', 'Lista de pedidoEntregados')

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="{{ asset('/css/index.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/responsive.css') }}" rel="stylesheet">
@stop

@section('content_header')
    <div class="admin-header">
        <div class="admin-nav-header">
            <a href="{{route("admin.home")}}" class="admin-nav-header__a" title="Ir al inicio"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a>
            <p style="font-weight: bolder; margin:0 5px"> / </p>
            <a href="{{route("admin.pedidos.entregados")}}" class="admin-nav-header__a admin-nav-header__a-active">Pedidos entregados</a>
        </div>
        <div class="admin-title-header">
            <h2 class="admin-title-header__h2">Pedidos entregados</h2>
            <span class="admin-title-header__span">
                <img class="admin-title-header__img" src="../images/pedidos.png" alt="PedidoEntregado png">
            </span>
        </div>
    </div>
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
                        <th >PedidoEntregado Nro</th>
                        <th >Cliente</th>
                        <th >Telefono</th>
                        <th >Direccion</th>
                        <th class="text-center">PedidoEntregado</th>
                        <th >Forma de pago</th>
                        <th >Envio</th>
                        <th >Total</th>
                        <th >Fecha y hora</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pedidosEntregados as $pedidoEntregado)
                        <tr style="background: none; max-height: 50px">
                            <td style="width: 10%">{{ $pedidoEntregado->id }}</td>
                            <td style="width: 10%">{{ $pedidoEntregado->cliente }}</td>
                            <td style="width: 10%">{{ $pedidoEntregado->telefono }}</td>
                            <td style="width: 10%">{{ $pedidoEntregado->direccion }}</td>
                            <td style="margin: 0 auto" class="d-flex align-items-center justify-content-center"><button type="btn" title="Ver pedidoEntregado" class="btn btn-dark" onclick="verPedidoEntregado();"><i class="fa fa-eye" aria-hidden="true"></i></button></td>
                            <td style="width: 10%">{{ $pedidoEntregado->metodo_de_pago }}</td>
                            <td style="width: 10%"><span class="bg-primary rounded p-1">{{ $pedidoEntregado->envio }}</span></td>
                            <td style="width: 10%">{{ $pedidoEntregado->total }}</td>
                            <td style="width: 10%">{{ $pedidoEntregado->create_time }}</td>
                        </tr>
                        <script>
                            function verPedidoEntregado() {
                                return Swal.fire({
                                title: 'Detalles del pedidoEntregado' ,
                                html: `
                                    <b>Direccion de envio: </b>{{$pedidoEntregado->direccion}}<br></br>
                                    <b>Metodo de pago: </b> {{$pedidoEntregado->metodo_de_pago}}<br></br>
                                    <b>Envío: </b> {{$pedidoEntregado->envio}}<br></br>
                                    <b>Total a pagar: </b> {{$pedidoEntregado->total}}<br></br>
                                    <b>PedidoEntregado: </b> {{$pedidoEntregado->pedido}}
                                    <b>{{$pedidoEntregado->pedido}}
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
                emptyTable: "No se registraron pedidoEntregados hasta el momento",
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
