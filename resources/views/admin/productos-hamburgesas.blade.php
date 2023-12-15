@extends('adminlte::page')

@section('title', 'Lista de pedidos')

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="{{ asset('/css/index.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/responsive.css') }}" rel="stylesheet">
@stop

@section('content_header')
    <h2>Lista de hamburguesas</h2>
@stop

@section('content')

    @if(session('success'))
    <div class="alert alert-success alert-block">
        <strong >{{session('success')}}</strong>
    </div>
    @endif
    {{-- <a href="{{route('admin.crear.producto')}}" class="crear-producto-btn btn-danger btn mb-3" type="submit">Crear producto</a> --}}
    
        <table id="example" class="table table-striped" style="width:100%">
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
                @foreach ($hamburgesas as $hamburgesa)
                    <tr>
                        <td>{{ $hamburgesa->id }}</td>
                        <td>{{ $hamburgesa->nombre }}</td>
                        <td>{{ $hamburgesa->descripcion }}</td>
                        <td>${{ $hamburgesa->precio }}</td>
                        <td><img src="/restaurante-app/public/productos/{{$hamburgesa->imagen}}" width="70px" height="50px"></td>
                        <td>
                            <a href="{{$hamburgesa->id}}/edit" class="btn btn-primary">Editar</a></div>
                            <a href="{{$hamburgesa->id}}/delete" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a></div>
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


