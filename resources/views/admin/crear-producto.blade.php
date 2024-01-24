@extends('adminlte::page')

@section('title', 'Admin Panel ')

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="{{ asset('/css/index.css') }}" rel="stylesheet">
@stop

@section('content_header')
    
@stop


@section('content')

@if(session('success'))
    <div class="alert alert-success w-75 mb-2 text-center m-auto d-flex justify-content-center alert-block">
        <strong >{{session('success')}}</strong>
    </div>
@endif

    <div class="container w-50 h-100 d-flex pt-5  flex-wrap ">

        <div class="w-100 h-100 m-auto shadow-lg bg-light">
            <h3 class="bg-dark text-center p-2 m-0">Crear nuevo producto</h3>
            <div class="row justify-content-center">
                <div>
                    <form class="d-flex flex-column p-3 gap-2" method="POST" action="{{route("admin.producto.store")}}" enctype="multipart/form-data">
                        @csrf
                        <div class="w-100 h-100 m-auto">
                            <div class="form group">
                                <label>Nombre</label>
                                <input type="text" name="nombre" class="form-control shadow-lg border-1" required value="{{old("nombre")}}">
                                @if ($errors->has("nombre"))
                                    <span class="text-danger">{{$errors->first("nombre")}}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Descripcion</label>
                                <textarea class="form-control form-descripcion shadow-lg" style="min-height: 150px; max-height: 150px" name="descripcion">{{old("descripcion")}}</textarea>
                                @if ($errors->has("descripcion"))
                                    <span class="text-danger">{{$errors->first("descripcion")}}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Precio</label>
                                <input type="text" name="precio" class="form-control border-1 shadow-lg" required>
                                @if ($errors->has("precio"))
                                    <span class="text-danger">{{$errors->first("precio")}}</span>
                                @endif
                            </div>
                            <div class="form-group d-flex align-items-center gap-2">
                                <label>Categoria</label>
                                <select name="categoria" id="">
                                    <option value="hamburgesa">Hamburguesa</option>
                                    <option value="bebida">Bebida</option>
                                </select>
                                {{-- @if ($errors->has("categoria"))
                                    <span class="text-danger">{{$errors->first("categoria")}}</span>
                                @endif --}}
                            </div>
                            <div class="form-group">
                                <label>Stock</label>
                                <input type="number" name="stock" class="form-control border-1 shadow-lg" value="{{old("stock")}}">
                                @if ($errors->has("stock"))
                                    <span class="text-danger">{{$errors->first("stock")}}</span>
                                @endif
                            </div>
                            <div class="form-group d-flex align-items-center gap-3">
                                <label>Imagen</label>
                                <input type="file" name="imagen" required class="form-control border-1 shadow-lg">
                                @if ($errors->has("imagen"))
                                <span class="text-danger">{{$errors->first("imagen")}}</span>
                                @endif
                            </div>
                        </div>

                        <div class="container w-100 d-flex justify-content-center align-items-center">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-plus" aria-hidden="true"></i> Crear producto</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        
    </div>
    
@stop


@section('js')
    
@stop