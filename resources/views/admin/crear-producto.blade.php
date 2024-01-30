@extends('adminlte::page')

@section('title', 'Admin Panel ')

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="{{ asset('/css/index.css') }}" rel="stylesheet">
@stop

@section('content_header')

@stop


@section('content')

    @if (session('success'))
        <div class="alert alert-success w-75 mb-2 text-center m-auto d-flex justify-content-center alert-block">
            <strong>{{ session('success') }}</strong>
        </div>
    @endif

    <div class="container w-50 h-100 d-flex pt-5  flex-wrap ">

        <div class="w-100 h-100 m-auto shadow-lg bg-light">
            <h3 class="bg-dark text-center p-2 m-0">Crear nuevo producto</h3>
            <div class="row justify-content-center">

                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <form class="d-flex flex-column p-3 gap-2" method="POST" action="{{ route('admin.producto.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                                <label class="m-0" for="nombreProducto">*Nombre del Producto:</label>
                                <input type="text" class="form-control" id="nombreProducto" name="nombre" required>
                
                                <label class="m-0" for="descripcion">Descripción:</label>
                                <textarea class="form-control" id="descripcion" name="descripcion"></textarea>
                
                                <label class="m-0" for="precio">*Precio:</label>
                                <input type="number" class="form-control" id="precio" name="precio" step="0.01" required>
                
                                <label class="m-0" for="categoria">*Categoría:</label>
                                <select class="form-control" id="categoria" name="categoria" onchange="activarCampo()" required>
                                    <option value="" disabled selected>Selecciona una categoria</option>
                                    @foreach ($categorias as $categoria)
                                        <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>    
                                    @endforeach
                                </select>

                                <label class="m-0" for="stock">Stock:</label>
                                <input type="number" class="form-control" id="stock" name="stock">
                
                                <label class="m-0" for="imagen">*Imagen:</label>
                                <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*" required>
                
                                <button type="submit" class="btn btn-success">Guardar Producto</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

@stop


@section('js')

@stop
