@extends('layouts.plantilla')

@section('title', 'Menu')

@section('css')
    
@endsection

@section('contenido')

    <div class="login-container">

        <div class="login-wrapp container">

            {{-- BOX1 --}}
            <div class="login-card card border-0 w-100 d-flex align-items-center justify-content-center h-100">
                <x-guest-layout>
            
                    <x-validation-errors class="mb-4" />
            
                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif
            
                    <form method="POST" class="login-form" action="{{ route('login') }}">
                        @csrf
            
                        <div class="input-field">
                            <div class="d-flex align-items-center gap-1">
                                <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                <x-label for="email" id="label-email" value=" {{ __('Email') }}" />
                            </div>
                            <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        </div>
            
                        <div class="mt-4">
                            <div class="d-flex align-items-center gap-1">
                                <i class="fa fa-key" aria-hidden="true"></i>
                                <x-label for="password" value="{{ __('Contraseña') }}" />
                            </div>
                            <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                        </div>
            
                        <div class="flex items-center justify-end mt-4">
                            {{-- @if (Route::has('password.request'))
                                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                                    {{ __('¿Olvidaste tu contraseña?') }}
                                </a>
                            @endif --}}
            
                            <x-button class="ms-4 me-2 bg-danger btn">
                                {{ __('Ingresar') }}
                            </x-button>
                            <a href="/restaurante-app/public/register" class="bg-dark text-light rounded" style="padding: 6px 20px; text-transform: uppercase; font-weight: bold; font-size: .85rem">
                                Registrarse
                            </a>
                        </div>
                    </form>
            </x-guest-layout>
            </div>
 
            {{-- BOX2 --}}
            <div class="login-card login-card-img w-100">
                <div class="login-img rounded">
                    <p class="login-card__p">Regístrate hoy para descubrir la magia de tener tus comidas favoritas a solo unos clics de distancia</p>
                </div>
            </div>
           

        </div>
        
    </div>

    

@endsection

@section('scripts')
    
@endsection

