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
        <img class="admin-title-header__img" src="../images/comidas.png" alt="Pedido png">
    </span>
    <h2 class="admin-title-header__h2">Lista de productos</h2>
</div>
@stop

@section('content')

    @if(session('success'))
    <div class="alert alert-success alert-block">
        <strong >{{session('success')}}</strong>
    </div>
    @endif
    <a href="{{route('admin.crear.producto')}}" class="crear-producto-btn btn-danger btn mb-3" type="submit"><i class="fa fa-plus-circle" aria-hidden="true"></i> Crear nuevo producto</a>
    
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th style="min-width: 35px; max-width: 35px;">ID</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Imagen</th>
                    <th style="max-width: 120px;">Accion</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productos as $producto)
                    <tr>
                        <td>{{ $producto->id }}</td>
                        <td>{{ $producto->nombre }}</td>
                        <td>{{ $producto->descripcion }}</td>
                        <td>${{ $producto->precio }}</td>
                        <td>{{ $producto->stock }}</td>
                        <td><img src="/restaurante-app/public/productos/{{$producto->imagen}}" width="70px" height="50px"></td>
                        <td>
                            <a title="Editar" href="producto/{{$producto->id}}/edit" class="btn btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></a></div>
                            <a title="Eliminar" href="producto/{{$producto->id}}/delete" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a></div>
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


