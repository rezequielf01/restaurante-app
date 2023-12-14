@extends('adminlte::page')

@section('title', 'Lista de pedidos')

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="{{ asset('/css/index.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/responsive.css') }}" rel="stylesheet">
@stop

@section('content_header')

@stop

@section('content')

<div class="table-container container h-100 d-flex justify-content-center flex-column align-items-center">
    @if(session('success'))
    <div class="alert alert-success alert-block">
        <strong >{{session('success')}}</strong>
    </div>
    @endif
<div class="card-table-container container bg-light shadow-lg mb-5 bg-body rounded p-3" style="border-radius: 5px; position: relative;" >

    <div class="table-icon shadow-lg">
        <img style="width: 100%" src="{{ asset('/images/hamburguesa.png') }}" alt="">
    </div>
    {{-- <a href="{{route('admin.crear.producto')}}" class="crear-producto-btn btn-danger btn mb-3" type="submit">Crear producto</a> --}}
    
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
                @foreach ($hamburgesas as $hamburgesa)
                    <tr>
                        <td>{{ $hamburgesa->id }}</td>
                        <td>{{ $hamburgesa->nombre }}</td>
                        <td>{{ $hamburgesa->descripcion }}</td>
                        <td>${{ $hamburgesa->precio }}</td>
                        <td><img src="/restaurante-app/public/productos/{{$hamburgesa->imagen}}" width="70px" height="50px"></td>
                        <td>
                            <a href="{{$hamburgesa->id}}/edit" class="btn btn-primary">Editar</a></div>
                            <a href="{{$hamburgesa->id}}/delete" class="btn btn-danger">Eliminar</a></div>
                        </td>
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


