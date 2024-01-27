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
            <h3 class="bg-dark text-center p-2 m-0">Crear nueva categoria</h3>
            <div class="row justify-content-center">
                <div>
                    <form method="POST" action="{{route('admin.categoria.store')}}" enctype="multipart/form-data">
                        @csrf
                        <label for="nombreCategoria">Nombre:</label>
                        <input type="text" name="categoria" required>
                        <br>
                        <label for="iconoCategoria">Icono:</label>
                        <input type="file" name="icono" required>
                        <br>
                        <button type="submit">Agregar categoria</button>
                    </form>
                </div>
            </div>
        </div>

    </div>

@stop


@section('js')

@stop
