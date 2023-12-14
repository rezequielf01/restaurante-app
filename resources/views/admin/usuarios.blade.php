@extends('adminlte::page')

@section('title', 'Lista de pedidos')

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="{{ asset('/css/index.css') }}" rel="stylesheet">
@stop

@section('content_header')
    
@stop

@section('content')
<div class="container w-75 h-100 d-flex justify-content-center align-items-center">
    <div class="container bg-light shadow-lg p-3 mb-5 bg-body rounded p-3" style="position: relative; margin-top: 150px;" >
    
        <div class="table-icon shadow-lg p-3">
            <img style="width: 100%" src="{{ asset('/images/usuarios.png') }}" alt="">
        </div>
    
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
    
    </div>
</div>

@stop

@section('js')
    <script>
        $('#example').dataTable( {
            responsive: true,
        } );
    </script>
@stop