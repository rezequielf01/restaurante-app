@extends('layouts.plantilla')
@section('title', 'Mi carrito')
@section('contenido')
<div class="checkout-container shadow-lg mb-5 bg-white rounded">
        @if (session('danger'))
            <div class="alert-carrito-restar alert alert-danger mb-2 text-center m-auto d-flex justify-content-center alert-block">
                <strong>{{ session('danger') }}</strong>
            </div>
        @endif
        @if (session('success'))
            <div class="alert-carrito-restar alert alert-success mb-2 text-center m-auto d-flex justify-content-center alert-block">
                <strong>{{ session('success') }}</strong>
            </div>
        @endif
        <div class="checkout-subcontainer d-flex flex-row flex-wrap justify-content-around">

            <div class="checkout-items card" style="border: none;">
                <div class="checkout-items-list">
                    @if (Cart::count())

                        @foreach (Cart::content() as $producto)
                            <div class="card w-100 shadow-lg mb-3 bg-white rounded" style="height: 150px; border:none">
                                <div
                                    class="card-body d-flex flex-row w-100 align-items-center justify-content-center justify-content-sm-around">
                                    <div class="card-img w-25">
                                        <img src="/restaurante-app/public/productos/{{ $producto->options->imagen }}"
                                            width="100%" height="100px" alt="">
                                    </div>
                                    <div class="card-info w-50">
                                        <h2 class="checkout-card__h2">{{ $producto->name }}</h2>
                                        <span><b>Precio unitario: </b>{{ number_format($producto->price) }}</span><br>
                                        <span><b>Precio final:
                                            </b>{{ number_format($producto->qty * $producto->price) }}</span><br>
                                        <span><b>Cantidad: </b>{{ $producto->qty }}</span>
                                    </div>
                                    <form class="d-flex w-25 justify-content-center"
                                        action="{{ route('carrito.delete.item', $producto->rowId) }}" method="post">
                                        @csrf
                                        <input type="hidden" name="rowId" value="{{ $producto->rowId }}">
                                        <div class="d-flex flex-column justify-content-center p-1 gap-1">
                                            <a href="incrementar/{{$producto->rowId}}" class="btn btn-danger"><i class="fa fa-plus"
                                                    aria-hidden="true"></i></a>
                                            <button type="button" class="btn">{{ $producto->qty }}</button>
                                            <a href="restar/{{$producto->rowId}}" class="btn btn-danger"><i class="fa fa-minus"
                                                    aria-hidden="true"></i></a>
                                        </div>
                                        <button type="submit" name="btn" class="btn btn-danger text-light"><i
                                                class="fa fa-trash-o" aria-hidden="true"></i></button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                        
                    @else
                        <p><i class="fa fa-shopping-cart" aria-hidden="true" style="margin-right: 5px"></i>No tienes productos en tu carrito</p>
                    @endif

                </div>
                <div class="card-body m-auto">
                    <a href="{{ route('carrito.clear') }}" class="btn btn-dark">Vaciar carrito</a>
                    <a href="{{ route('menu') }}" class="btn btn-danger">Volver al menú</a>
                </div>
            </div>
            <div class="checkout-ticket card d-flex align-items-center justify-content-center shadow-lg p-3 bg-white rounded">
                <h4 class="text-center"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Dellates de la compra</h4>
                <form class="d-flex flex-column gap-2 mt-5 mb-5 align-items-left" style="position: relative; z-index:10;"
                    method="POST" action="{{ route('carrito.enviar.pedido') }}">
                    @csrf
                    <label>Cliente:
                        <input type="text" name="cliente_id" placeholder="abc" value="{{ auth()->user()->id }}"
                            style="border:none; display: none">@php
                                echo ucfirst(auth()->user()->name);
                            @endphp
                    </label>

                    <label class="d-flex align-items-center justify-content-start gap-2">Dirección:
                        <input type="text" disabled id="direccion" style="width: 50%; border: none; padding: 2px 5px; border-radius: 3px" name="direccion" placeholder="{{ auth()->user()->direccion }}">
                        <div class="bg-danger shadow-lg" style="border-radius: 2px; cursor: pointer;" title="Editar dirección" onclick="editDireccion()">
                            <i class="p-2 fa fa-pencil" aria-hidden="true"></i>
                        </div>
                    </label>
                    {{-- <label>Telefono:
                        <input type="text" name="telefono" placeholder="abc" value="{{ auth()->user()->telefono }}"
                            style="border:none">
                    </label>
                    <label>Direccion:
                        <input type="text" name="direccion" placeholder="abc" value="{{ auth()->user()->direccion }}"
                            style="border:none">
                    </label>

                    <div class="d-flex flex-column">
                        <label hidden>Pedido:</label>
                        <textarea name="pedido" id="" rows="10" hidden
                            style="min-height: 150px; max-height: 150px; border:none; overflow:auto;">
                            @foreach (Cart::content() as $producto)
                            {{$producto->qty}}            {{$producto->name}}             ${{$producto->price}}
                            @endforeach
                        </textarea> --}}
                        {{-- <label style="font-weight: bold" name="total">Total:
                            <input type="text" style="border: none; font-weidth: bold" inputmode="decimal" name="total" value="{{Cart::Total()}}">
                        </label> --}}
                    {{-- </div> --}}
                    
                    <p>Total: <span style="font-weight: bold">${{Cart::Total()}}</span></p>
                    <div style="position: relative; z-index: 50; top: 0;"
                        class="w-100 mt-5 gap-2 d-flex flex-column justify-content-center">
                        {{-- <label>Forma de pago:
                            <select name="metodo_de_pago" style="border: solid px #f1f1f1;" id="">
                                <option value="Efectivo">Efectivo</option>
                                <option value="Transferencia">Transferencia</option>
                            </select>
                        </label>
                        <label for="envio"><input type="checkbox" id="" name="envio" value="retira en local"> <i class="fa fa-home" aria-hidden="true"></i> Retiro en local</label>
                        <label for="envio"><input type="checkbox" id="" name="envio" value="delivery a domicilio"> <i class="fa fa-motorcycle" aria-hidden="true"></i> Delivery</label>
                        @if ($errors->has("envio"))
                            <span class="text-danger">{{$errors->first("envio")}}</span>
                        @endif --}}
                        @if ( Cart::total() > 0)
                        <button class="btn btn-danger" type="submit">Enviar pedido</button>
                        @else
                        <button class="btn btn-danger" disabled type="submit">Enviar pedido</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function editDireccion(){
            var direccionInput = document.getElementById('direccion');
            direccionInput.disabled = false;
            direccionInput.focus();
        } 
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@stop
