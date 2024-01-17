@extends('adminlte::page')

@section('title', 'Lista de pedidos')

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
            <a href="{{route("admin.pedidos.entregados")}}" class="admin-nav-header__a admin-nav-header__a-active">Pedidos pendientes</a>
        </div>
        <div class="admin-title-header">
            <h2 class="admin-title-header__h2">Pedidos pendientes</h2>
            <span class="admin-title-header__span">
                <img class="admin-title-header__img" src="../images/pedidos.png" alt="Pedido png">
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
                        <th >Pedido Nro</th>
                        <th >Cliente</th>
                        <th >Telefono</th>
                        <th >Direccion</th>
                        <th class="text-center">Pedido</th>
                        <th >Forma de pago</th>
                        <th >Envio</th>
                        <th >Total</th>
                        <th >Fecha y hora</th>
                        <th >Accion</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pedidos as $pedido)
                        <tr style="background: none; max-height: 50px">
                            <td style="width: 10%">{{ $pedido->id }}</td>
                            <td style="width: 10%">{{ $pedido->cliente }}</td>
                            <td style="width: 10%">{{ $pedido->telefono }}</td>
                            <td style="width: 10%">{{ $pedido->direccion }}</td>
                            <td style="margin: 0 auto" class="d-flex align-items-center justify-content-center"><button type="btn" title="Ver pedido" class="btn btn-dark" onclick="verPedido();"><i class="fa fa-eye" aria-hidden="true"></i></button></td>
                            <td style="width: 10%">{{ $pedido->metodo_de_pago }}</td>
                            <td style="width: 10%"><span class="bg-primary rounded p-1">{{ $pedido->envio }}</span></td>
                            <td style="width: 10%">{{ $pedido->total }}</td>
                            <td style="width: 10%">{{ $pedido->create_time }}</td>
                            <td style="margin: 0 auto" class="d-flex align-items-center justify-content-center gap-3">
                                <a href="pedidos/{{ $pedido->id }}/entregado" title="Entregado" style="color: rgb(80, 248, 80); background: white; box-shadow: 0 0 5px rgba(0, 0, 0, 0.2); border: solid 1px rgba(0, 0, 0, 0.2)" class="btn">
                                    <i class="fa fa-check" aria-hidden="true"></i>
                                </a>
                                <a href="pedidos/{{ $pedido->id }}/cancelado" title="Cancelado" style="color: rgb(255, 15, 15); background: white; box-shadow: 0 0 5px rgba(0, 0, 0, 0.2); border: solid 1px rgba(0, 0, 0, 0.2)" class="btn">
                                    <i class="fa fa-ban" aria-hidden="true"></i>
                                </a>
                                <a href="pedido/{{$pedido->id}}" title="Imprimir factura" style="color: rgb(15, 107, 255); background: white; box-shadow: 0 0 5px rgba(0, 0, 0, 0.2); border: solid 1px rgba(0, 0, 0, 0.2)" class="btn">
                                    <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                        <script>
                            function verPedido() {
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
