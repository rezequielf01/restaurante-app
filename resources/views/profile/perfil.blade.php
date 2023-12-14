@extends('layouts.plantilla')

@section('title', 'Menu')

@section('css')
    <link href="{{ asset('/css/slick.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/slick-theme.css') }}" rel="stylesheet">
@endsection

@section('contenido')

    <div class="container w-75" style="margin-top: 10vh">

        <form wire:submit.prevent="updatePassword">
            <input id="current-password" type="password" name="current_password" required="true" />
            @error('current_password')

            <label id="current-password-err" class="error" for="current-password">{{ $message }}</label>
            @enderror

            <input id="password" type="password" name="password" required="true" />
            @error('password')

            <label id="password-err" class="error" for="password">{{ $message }}</label>
            @enderror

            <input id="password-confirmation" type="password" name="password_confirmation" required="true" />
            @error('password_confirmation')

            <label id="password-confirmation-err" class="error" for="password-confirmation">{{ $message }}</label>
            @enderror
            
            <button type="submit">Change Password</button>
        </form>

    </div>

@endsection

@section('scripts')
    <script>
        $('#example3').dataTable( {
            responsive: true,
        } );
    </script>
@stop
