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
            <img class="admin-title-header__img" src="../images/categoria.png" alt="Pedido png">
        </span>
        <h2 class="admin-title-header__h2">Lista de categorias</h2>
    </div>
@stop

@section('content')

    @if (session('success'))
        <div class="alert alert-success alert-block">
            <strong>{{ session('success') }}</strong>
        </div>
    @endif
    <form class="d-flex p-3 gap-2 mb-3" method="POST" action="{{ route('admin.categoria.store') }}"
        enctype="multipart/form-data"" enctype="multipart/form-data">
        @csrf
        <label class="m-0" for="nombreProducto">*Nombre de la categoria:
            <input type="text" class="form-control" id="nombreCategoria" name="nombre" required>
        </label>

        <label class="m-0" for="imagen">*Icono:
            <input type="file" class="form-control" id="imagen" name="icono" accept="image/*" required>
        </label>

        <div class="d-flex" style="align-items: flex-end">
            <button type="submit" class="btn ms-2 btn-danger"><i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar
                categoria</button>
        </div>
    </form>

    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th style="min-width: 35px; max-width: 35px;">ID</th>
                <th>Nombre</th>
                <th>Icono</th>
                <th style="max-width: 120px;">Accion</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categorias as $categoria)
                <tr>
                    <td>{{ $categoria->id }}</td>
                    <td>{{ $categoria->nombre }}</td>
                    <td><img src="../productos/{{ $categoria->icono }}" width="50px" height="50px"></td>
                    <td>
                        <a href="{{ $categoria->id }}/delete" class="btn btn-danger"><i class="fa fa-trash"
                                aria-hidden="true"></i></a></div>
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
