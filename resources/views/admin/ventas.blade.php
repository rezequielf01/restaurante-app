@extends('adminlte::page')

@section('title', 'Lista de pedidoEntregados')

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="{{ asset('/css/index.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/responsive.css') }}" rel="stylesheet">
@stop

@section('content_header')
    <div class="admin-header">
        <span class="admin-title-header__span">
            <img class="admin-title-header__img" src="../images/local.png" alt="PedidoEntregado png">
        </span>
        <h2 class="admin-title-header__h2">Ventas en local</h2>
    </div>
@stop

@section('content')

    @if (session('success'))
        <div class="alert alert-success w-75 mb-2 text-center m-auto d-flex justify-content-center alert-block">
            <strong>{{ session('success') }}</strong>
        </div>
    @endif

    <div class="bg-light shadow-lg p-3">
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Venta Nro</th>
                    <th>Cajero</th>
                    <th>Cliente</th>
                    <th>Mesa Nro</th>
                    <th>Forma de pago</th>
                    <th>Total</th>
                    <th>Fecha</th>
                    <th>Factura</th>
                </tr>
            </thead>
            <tbody>
          
                    @foreach ($detalle_ventas as $detalleVenta)
                        <tr style="background: none; max-height: 50px">
                            <td style="width: 5%">@if ($detalleVenta->id < 10)
                                00{{$detalleVenta->id}}
                            @else
                            0{{$detalleVenta->id}}
                            @endif</td>
                            <td style="width: 15%">{{ $detalleVenta->cajero }}</td>
                            <td style="width: 15%">{{ $detalleVenta->cliente }}</td>
                            <td style="width: 15%">{{ $detalleVenta->mesa_nro }}</td>
                            <td style="width: 15%">{{ $detalleVenta->forma_de_pago }}</td>
                            <td style="width: 15%">${{ $detalleVenta->total }}</td>
                            <td style="width: 15%">{{ $detalleVenta->created_at }}</td>
                            <td style="width: 15%">
                                <a href="{{route('admin.fpdf.venta.local',$detalleVenta->id)}}" target="_blank" title="Imprimir factura"
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
