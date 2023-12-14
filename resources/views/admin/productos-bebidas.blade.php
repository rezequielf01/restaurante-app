@extends('adminlte::page')

@section('title', 'Lista de pedidos')

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('content_header')
    <h1>Lista de productos</h1>
@stop

@section('content')
@if(session('success'))
    <div class="alert alert-success alert-block">
        <strong >{{session('success')}}</strong>
    </div>
@endif

    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Precio</th>
                <th>Imagen</th>
                <th>Accion</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bebidas as $bebida)
                <tr>
                    <td>{{ $bebida->id }}</td>
                    <td>{{ $bebida->nombre }}</td>
                    <td>{{ $bebida->descripcion }}</td>
                    <td>${{ $bebida->precio }}</td>
                    <td><img src="/restaurante-app/public/productos/{{$bebida->imagen}}" width="70px"></td>
                    <td>
                        <a href="{{$bebida->id}}/edit" class="btn btn-primary">Editar</a></div>
                        <a href="{{$bebida->id}}/delete" class="btn btn-danger">Eliminar</a></div>
                    </td>
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


