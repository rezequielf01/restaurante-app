@extends('layouts.plantilla')

@section('title', 'Menu')

@section('css')
    
@endsection

@section('contenido')

    <div class="login-container">

        <div class="container d-flex shadow-lg bg-light w-100 h-100 rounded p-0">

            <div class="login-card card border-0 d-flex align-items-center justify-content-center h-100">
                <x-guest-layout>

                    <x-validation-errors class="mb-4" />
            
                    <form method="POST" class="login-form d-flex flex-column gap-3" action="{{ route('register') }}">
                        @csrf
            
                        <div class="d-flex justify-content-center align-items-center gap-2">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <x-input id="name" class="block w-full" type="text" placeholder='Nombre' name="name" :value="old('name')" required autofocus autocomplete="name" />
                        </div>
            
                        <div class=" d-flex justify-content-center align-items-center gap-2">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                            <x-input id="email" class="block w-full" type="email" placeholder="Correo electronico" name="email" :value="old('email')" required autocomplete="username" />
                        </div>
            
                        <div class=" d-flex justify-content-center align-items-center gap-2">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            <x-input id="direccion" class="block w-full" type="text" placeholder="Direccion 123" name="direccion" :value="old('direccion')" required autofocus />
                        </div>
            
                        <div class="d-flex justify-content-center align-items-center gap-2">
                            <i class="fa fa-phone-square" aria-hidden="true"></i>
                            <x-input id="telefono" class="block w-full" type="text" placeholder="Número de telefono" name="telefono" :value="old('telefono')" required autofocus />
                        </div>
            
                        <div class=" d-flex justify-content-center align-items-center gap-2">
                            <i class="fa fa-key" aria-hidden="true"></i>
                            <x-input id="password" class="block w-full" type="password" placeholder="Contraseña" name="password" required autocomplete="new-password" />
                        </div>
            
                        <div class=" d-flex justify-content-center align-items-center gap-2">
                            <i class="fa fa-key" aria-hidden="true"></i>
                            <x-input id="password_confirmation" class="block w-full" type="password"  placeholder="Confirmar contraseña" name="password_confirmation" required autocomplete="new-password" />
                        </div>
            
                        @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                            <div class="mt-4">
                                <x-label for="terms">
                                    <div class="flex items-center">
                                        <x-checkbox name="terms" id="terms" required />
            
                                        <div class="ms-2">
                                            {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                    'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                                    'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                            ]) !!}
                                        </div>
                                    </div>
                                </x-label>
                            </div>
                        @endif
            
                        <div class="flex items-center justify-end mt-4">
                            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                                {{ __('¿Ya estás registrado?') }}
                            </a>
            
                            <x-button class="ms-4 bg-danger">
                                {{ __('Registrar') }}
                            </x-button>
                        </div>
                    </form>
            </x-guest-layout>
            </div>
 
            <div class="register-img border-0">
                <div class="login-img rounded-end"></div>
            </div>
           

        </div>
        
    </div>

    

@endsection

@section('scripts')
    
@endsection



