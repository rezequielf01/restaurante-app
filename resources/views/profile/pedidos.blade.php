@extends('layouts.plantilla')

@section('title', 'Menu')

@section('css')
    <link href="{{ asset('/css/slick.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/slick-theme.css') }}" rel="stylesheet">
@endsection

@section('contenido')

    <div class="container w-75" style="margin-top: 10vh">

        <h1>Mis pedidos</h1>

    </div>

@endsection

@section('scripts')
    <script>
        $('#example3').dataTable( {
            responsive: true,
        } );
    </script>
@stop
