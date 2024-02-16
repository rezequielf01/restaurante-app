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
            <img class="admin-title-header__img" src="/restaurante-app/public/images/mesa.png" alt="Mesa icono png">
        </span>
        <h2 class="admin-title-header__h2">Administracion de mesas</h2>
    </div>
@stop

@section('content')

    @if (session('success'))
        <div class="alert alert-success alert-block">
            <strong>{{ session('success') }}</strong>
        </div>
    @endif
    <a href="{{route('admin.crear.producto')}}" class="crear-producto-btn btn-danger btn mb-3" type="submit"><i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar mesa</a>
    
    <div class="mesas-container">

        @foreach ($mesas as $mesa)    
        <div class="mesa-box">
            <img class="mesa__img" src="/restaurante-app/public/images/mesa.png" alt="Mesa icono">
            <span class="mesa__estado d-flex flex-column">
                <p class="mesa__p">Mesa #{{$mesa->nro_mesa}}</p>
                <i class="fa fa-check-circle-o" aria-hidden="true"> Disponible</i>
            </span>
            <a href="mesas/{{$mesa->nro_mesa}}">Ir a mesa</a>
        </div>
        @endforeach

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
