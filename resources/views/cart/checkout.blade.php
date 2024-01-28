@extends('layouts.plantilla')
@section('title', 'Mi carrito')
@section('contenido')
    <div class="checkout-container shadow-lg mb-5 bg-white rounded">
        @if (session('danger'))
            <div
                class="alert-carrito-restar alert alert-danger mb-2 text-center m-auto d-flex justify-content-center alert-block">
                <strong>{{ session('danger') }}</strong>
            </div>
        @endif
        @if (session('success'))
            <div
                class="alert-carrito-restar alert alert-success mb-2 text-center m-auto d-flex justify-content-center alert-block">
                <strong>{{ session('success') }}</strong>
            </div>
        @endif


        <div class="checkout-subcontainer d-flex flex-row flex-wrap justify-content-around">

            <div class="checkout-items card" style="border: none;">
                <div class="checkout-items-list">
                    @if (Cart::count())

                        @foreach (Cart::content() as $producto)
                            <div id="producto-{{ $producto->rowId }}" class="card w-100 shadow-lg mb-3 bg-white rounded item"
                                style="height: 150px; border:none" data-id="{{ $producto->rowId }}" data-cantidad="{{ $producto->qty }}" data-precio="{{ $producto->price }}">
                                <div
                                    class="card-body d-flex flex-row w-100 align-items-center justify-content-center justify-content-sm-around">
                                    <div class="card-img w-25">
                                        <img src="/restaurante-app/public/productos/{{ $producto->options->imagen }}"
                                            width="100%" height="100px" alt="">
                                    </div>
                                    <div class="card-info w-50" style="margin-left: 5px">
                                        <h2 style="user-select: none;" class="checkout-card__h2">{{ $producto->name }}</h2>
                                        <span class="checkout-card__p" style="user-select: none;"><b>Precio unitario:
                                            </b>${{ number_format($producto->price) }}</span><br>
                                        <b class="checkout-card__p" style="user-select: none;">
                                            Precio final:
                                            <span id="precioFinal-{{ $producto->rowId }}" style="font-weight: 200">${{ number_format($producto->qty * $producto->price) }}</span> 
                                        </b>
                                    </div>
                                    <form class="d-flex w-25 justify-content-center"
                                        action="{{ route('carrito.delete.item', $producto->rowId) }}" method="post">
                                        @csrf
                                        <input type="hidden" name="rowId" value="{{ $producto->rowId }}">
                                        <div class="d-flex flex-column justify-content-center p-1 gap-1">

                                            <button id="sumar-btn" type="button"
                                                style="background: var(--color-principal); color:white;"
                                                class="btn sumar-item">
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                            </button>

                                            <span id="cantidad-{{ $producto->rowId }}"
                                                style="text-align: center">{{ $producto->qty }}</span>

                                            <button id="restar-btn" type="button"
                                                style="background: var(--color-principal); color:white;"
                                                class="btn restar-item">
                                                <i class="fa fa-minus" aria-hidden="true"></i>
                                            </button>

                                        </div>
                                        <button id="eliminar-item" type="button" name="btn"
                                            style="background: var(--color-principal); color: white;"
                                            class="btn eliminar-item">
                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p><i class="fa fa-shopping-cart" aria-hidden="true" style="margin-right: 5px"></i>No tienes
                            productos en tu carrito</p>
                    @endif

                </div>
                <div class="card-body m-auto">
                    <a href="{{ route('carrito.clear') }}" class="btn btn-dark">Vaciar carrito</a>
                    <a href="{{ route('menu') }}" class="btn"
                        style="background: var(--color-principal); color: white;">Volver al menú</a>
                </div>
            </div>
            <div
                class="checkout-ticket card d-flex align-items-center justify-content-center shadow-lg p-3 bg-white rounded">
                <h4 class="text-center">Dellates de la compra</h4>
                <form onsubmit="return validarFormulario()" class="d-flex flex-column gap-2 mt-5 mb-5 align-items-left"
                    style="position: relative; z-index:10;" method="POST" action="{{ route('carrito.enviar.pedido') }}">
                    @csrf
                    <label>Cliente:
                        <input type="text" name="cliente_id" placeholder="abc" value="{{ auth()->user()->id }}"
                            style="border:none; display: none">@php
                                echo ucfirst(auth()->user()->name);
                            @endphp
                    </label>

                    <label class="d-flex align-items-center justify-content-start gap-2">Dirección:
                        <input type="text" disabled id="direccion"
                            style="width: 50%; border: none; padding: 2px 5px; border-radius: 3px" name="direccion"
                            placeholder="{{ auth()->user()->direccion }}">
                        <button type="button" class="shadow-lg"
                            style="background: #212529; color: white; ;border-radius: 2px; cursor: pointer; border: none;"
                            title="Editar dirección" onclick="editDireccion()">
                            <i class="p-2 fa fa-pencil" aria-hidden="true"></i>
                        </button>
                    </label>

                    <label for="envio"><input type="checkbox" class="checkbox" id="checkboxLocal" name="envio"
                            value="retira en local"> <i class="fa fa-home" aria-hidden="true"></i> Retiro en local</label>
                    <label for="envio"><input type="checkbox" class="checkbox" id="checkboxDelivery" name="envio"
                            value="delivery a domicilio"> <i class="fa fa-motorcycle" aria-hidden="true"></i>
                        Envio a domicilio</label>


                    <p>Total: <span id="valor-total"
                            style="font-weight: bold; user-select: none;">${{ cart::total() }}</span></p>
                    <div style="position: relative; z-index: 50; top: 0;"
                        class="w-100 mt-5 gap-2 d-flex flex-column justify-content-center">
                        {{-- <label>Forma de pago:
                            <select name="metodo_de_pago" style="border: solid px #f1f1f1;" id="">
                                <option value="Efectivo">Efectivo</option>
                                <option value="Transferencia">Transferencia</option>
                            </select>
                        </label>
                        
                        <label for="envio"><input type="checkbox" id="" name="envio" value="delivery a domicilio"> <i class="fa fa-motorcycle" aria-hidden="true"></i> Delivery</label>
                        @if ($errors->has('envio'))
                            <span class="text-danger">{{$errors->first("envio")}}</span>
                        @endif --}}
                        @if (Cart::total() > 0)
                            <button class="btn" id="enviarPedidoBtn" style="background: var(--color-principal); color: white;"
                                type="submit">Enviar pedido</button>
                        @else
                            <button class="btn" style="background: var(--color-principal); border: none;" disabled
                                type="submit">Enviar pedido</button>
                        @endif
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')

    <script>
        $(document).ready(function() {

            function funcionesCarrito(url, type , id, successCallback) {
                $.ajax({
                    url: url + id,
                    type: type,
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(respuesta) {
                        successCallback(respuesta);
                        // Después de recibir la respuesta, obtén el nuevo total
                        obtenerNuevoTotal();
                        
                    },
                });
            }

            // Función para obtener y actualizar el total del carrito
            function obtenerNuevoTotal() {
                $.ajax({
                    url: '{{ route('carrito.total') }}',
                    type: 'GET',
                    success: function(response) {
                        // Actualiza la interfaz con el nuevo total
                        $('#valor-total').text("$" + response.total);
                    },
                    error: function(error) {
                        console.error('Error al obtener el total del carrito:', error);
                    }
                });
            }

            $('.sumar-item').click(function() {
                let id = $(this).closest('.item').data('id');
          
                funcionesCarrito('incrementar/', "GET" , id, function(respuesta) {
                    $('#cantidad-' + id).text(respuesta.qty);
                    $('#precioFinal-' + id).text("$"+respuesta.precioFinal);
                    // document.getElementById('cantidadCarrito2').innerHTML = respuesta
                    //         .cantidad;
                });

            });

            $('.restar-item').click(function() {
                let id = $(this).closest('.item').data('id');
                funcionesCarrito('restar/', "GET" , id, function(respuesta) {
                    $('#cantidad-' + id).text(respuesta.qty);
                    $('#precioFinal-' + id).text("$"+respuesta.precioFinal);
                    // document.getElementById('cantidadCarrito2').innerHTML = respuesta
                    //         .cantidad;
                });
            });



            $('.eliminar-item').click(function() {
                let id = $(this).closest('.item').data('id');
                $.ajax({
                    url: '{{ route('carrito.delete.item') }}',
                    type: 'POST',
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(respuesta) {
                        $('#producto-' + id).remove();
                        $('#valor-total').text("$" + respuesta.total);
                        // document.getElementById('cantidadCarrito2').innerHTML = respuesta
                        //     .cantidad;
                        if(respuesta.total == 0){
                            $('#enviarPedidoBtn').attr('disabled', 'disabled');
                        }
                    },
                });
            });

            // $('.sumar-item, .restar-item').on('click', function() {

            //     $.ajax({
            //         url: '{{ route('carrito.total') }}',
            //         method: 'GET',
            //         success: function(response) {
            //             // Actualiza la interfaz con el nuevo total
            //             $('#valor-total').text(response.nuevoTotal);
            //         },
            //         error: function(error) {
            //             console.error('Error en la llamada AJAX:', error);
            //         }
            //     });
            // });

        });
    </script>

    <script>
        // VALIDACION DE FORMULARIO
        function validarFormulario() {
            let checkboxLocal = document.getElementById('checkboxLocal');
            let checkboxDelivery = document.getElementById('checkboxDelivery');

            if (!checkboxLocal.checked && !checkboxDelivery.checked) {
                Swal.fire({
                    icon: "question",
                    text: "¿Necesitás que llevemos tú pedido?",
                    confirmButtonColor: '#212529',
                });
                return false;
            } else if ((checkboxLocal && !checkboxDelivery) || (!checkboxLocal && checkboxDelivery)) {
                return true;
            }
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // EVITAR MULTIPLE SELECCION DE CHECKBOX
            let input = document.getElementById('direccion');

            input.addEventListener('blur', function() {
                // Desactivar el input cuando pierde el foco
                input.disabled = true;
            });

            // CHECKBOX
            let checkboxes = document.querySelectorAll('.checkbox');

            checkboxes.forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    if (this.checked) {
                        // Desactivar los otros checkboxes
                        checkboxes.forEach(function(otherCheckbox) {
                            if (otherCheckbox !== checkbox) {
                                otherCheckbox.disabled = true;
                            }
                        });
                    } else {
                        // Habilitar todos los checkboxes
                        checkboxes.forEach(function(otherCheckbox) {
                            otherCheckbox.disabled = false;
                        });
                    }
                });
            });
        });
    </script>

    {{-- EDITAR DIRECCION --}}
    <script>
        function editDireccion() {
            var direccionInput = document.getElementById('direccion');
            direccionInput.disabled = false;
            direccionInput.focus();
        }

        direccionInput.addEventListener('blur', function() {
            // Desactivar el input cuando pierde el foco
            input.disabled = true;
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@stop
