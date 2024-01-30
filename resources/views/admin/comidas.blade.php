@extends('adminlte::page')

@section('title', 'Lista de comidas')

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
            <a href="{{route("admin.productos.comidas")}}" class="admin-nav-header__a admin-nav-header__a-active">Comidas</a>
        </div>
        <div class="admin-title-header">
            <h2 class="admin-title-header__h2">Lista de comidas</h2>
            <span class="admin-title-header__span">
                <img class="admin-title-header__img" src="../images/pedidos.png" alt="plato png">
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

        {{-- <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th style="min-width: 35px; max-width: 35px;">ID</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Precio</th>
                    <th>Imagen</th>
                    <th style="max-width: 120px;">Accion</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($comidas as $comida)
                    <tr>
                        <td>{{ $comida->id }}</td>
                        <td>{{ $comida->nombre }}</td>
                        <td>{{ $comida->descripcion }}</td>
                        <td>${{ $comida->precio }}</td>
                        <td><img src="/restaurante-app/public/productos/{{$comida->imagen}}" width="70px" height="50px"></td>
                        <td>
                            <a href="{{$comida->id}}/edit" title="Editar" class="btn btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></a></div>
                            <a href="{{$comida->id}}/delete" title="Eliminar" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a></div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table> --}}

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
                emptyTable: "No se registraron comidas hasta el momento",
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
