@extends('adminlte::page')

@section('title', 'Lista de pedidos')

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="{{ asset('/css/index.css') }}" rel="stylesheet">
@stop

@section('content_header')
    <h2>Lista de clientes registrados</h2>
@stop

@section('content')

        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Direccion</th>
                    <th>Telefono</th>
                    <th>Contraseña</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usuarios as $usuario)
                    <tr>
                        <td>{{ $usuario->id }}</td>
                        <td>{{ $usuario->name }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td>{{ $usuario->direccion }}</td>
                        <td>{{ $usuario->telefono }}</td>
                        <td>{{ $usuario->password }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

@stop

@section('js')
    <script>
        $('#example').dataTable( {
            responsive: true,
        } );
    </script>
@stop