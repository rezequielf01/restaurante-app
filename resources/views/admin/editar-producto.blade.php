@extends('adminlte::page')

@section('title', 'Admin Panel ')

@section('css')
    
@stop

@section('content_header')
    
@stop


@section('content')

@if(session('success'))
    <div class="alert alert-success alert-block">
        <strong >{{session('success')}}</strong>
    </div>
@endif

<div class="container w-50 h-100 p-5 d-flex flex-column justify-content-center align-items-center">
    <h3 class="bg-dark text-center p-2 m-0 w-100">Editar producto #{{$producto->nombre}}</h3>
    <div class="w-100 h-100 m-auto shadow-lg p-3 bg-light rounded">
        <div class="row justify-content-center m-0">
            <div class="col mt-3 p-3">
                <form method="POST" action="update" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <div class="form group">
                        <label>Nombre</label>
                        <input type="text" name="nombre" class="form-control shadow-lg" value="{{old("nombre",$producto->nombre)}}">
                        @if ($errors->has("nombre"))
                            <span class="text-danger">{{$errors->first("nombre")}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Descripcion</label>
                        <textarea class="form-control shadow-lg" style="min-height: 150px; max-height: 150px" name="descripcion">{{old("descripcion",$producto->descripcion)}}</textarea>
                        @if ($errors->has("descripcion"))
                            <span class="text-danger">{{$errors->first("descripcion")}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Precio</label>
                        <input type="number" name="precio" class="form-control shadow-lg" value="{{old("precio",$producto->precio)}}">
                        @if ($errors->has("precio"))
                            <span class="text-danger">{{$errors->first("precio")}}</span>
                        @endif
                    </div>
                    <div class="form group">
                        <label>Categoria</label>
                        <select name="categoria" id="">
                            <option value="hamburgesa">Hamburgesa</option>
                            <option value="bebida">Bebida</option>
                        </select>
                        {{-- @if ($errors->has("categoria"))
                            <span class="text-danger">{{$errors->first("categoria")}}</span>
                        @endif --}}
                    </div>
                    <div class="form-group">
                        <label>Imagen</label>
                        <input type="file" name="imagen" value="{{old("imagen",$producto->imagen)}}" required class="form-control shadow-lg">
                        @if ($errors->has("imagen"))
                        <span class="text-danger">{{$errors->first("imagen")}}</span>
                        @endif
                    </div>
                    <div class="container w-100 d-flex justify-content-center align-items-center">
                        <button class="btn btn-primary" type="submit">Editar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@stop


@section('js')
    
@stop