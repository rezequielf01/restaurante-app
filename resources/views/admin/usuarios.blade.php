@extends('adminlte::page')

@section('title', 'Lista de usuarioEntregados')

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="{{ asset('/css/index.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/responsive.css') }}" rel="stylesheet">
@stop

@section('content_header')
    <div class="admin-header">
        <span class="admin-title-header__span">
            <img class="admin-title-header__img" src="../images/usuarios.png" alt="usuarioEntregado png">
        </span>
        <h2 class="admin-title-header__h2">Clientes registrados</h2>
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
                <th>ID</th>
                <th>Cliente</th>
                <th>Email</th>
                <th>Direccion</th>
                <th>Telefono</th>
                {{-- <th >Envio</th> --}}
                <th>Contraseña</th>
                <th>Fecha_registro</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usuarios as $usuario)
                <tr style="background: none; max-height: 50px">
                    <td style="width: 5%">{{ $usuario->id }}</td>
                    <td style="width: 15%">{{ $usuario->name }}</td>
                    <td style="width: 15%">{{ $usuario->email }}</td>
                    
                    <td style="width: 15%">{{ $usuario->direccion }}</td>
                    <td style="width: 15%"><a href="https://wa.me/{{ $usuario->telefono }}" target="_blank"
                        title="Abrir chat" style="background:rgb(86, 218, 86); color: white; border-radius: 3px"
                        class="p-1 text-decoration-none"><i class="fa fa-whatsapp" aria-hidden="true"></i>
                        {{ $usuario->telefono }}</a></td>
                    <td style="width: 15%">{{ $usuario->password }}</td>
                    <td style="width: 15%">{{ $usuario->created_at }}</td>
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
                emptyTable: "No se registraron usuarioEntregados hasta el momento",
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
