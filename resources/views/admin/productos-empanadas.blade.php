@extends('adminlte::page')

@section('title', 'Lista de pedidos')

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('content_header')
    <h1>Lista de productos</h1>
@stop

@section('content')
    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Precio</th>
                <th>Imagen</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($empanadas as $empanada)
                <tr>
                    <td>{{ $empanada->id }}</td>
                    <td>{{ $empanada->nombre }}</td>
                    <td>{{ $empanada->descripcion }}</td>
                    <td>${{ $empanada->precio }}</td>
                    <td>a</td>
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


