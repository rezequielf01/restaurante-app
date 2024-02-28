@extends('adminlte::page')

@section('title', 'Lista de pedidos')

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="{{ asset('/css/index.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/responsive.css') }}" rel="stylesheet">

    {{-- TOASTIFY - NOTIFICACIONES --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
@stop

@section('content_header')
    <div class="admin-header">
        <span class="admin-title-header__span">
            <img class="admin-title-header__img" src="../images/comidas.png" alt="Pedido png">
        </span>
        <h2 class="admin-title-header__h2">Lista de productos</h2>
    </div>
@stop

@section('content')

    @if (session('success'))
        <div class="alert alert-success alert-block">
            <strong>{{ session('success') }}</strong>
        </div>
    @endif
    <button id="mostrar-formulario" type="button" class="bn bg-danger border-0 p-2 rounded mb-3"><i
            class="fa fa-plus-circle" aria-hidden="true"></i> Crear un nuevo producto</button>

    <div class="bg-light shadow-lg p-3">
        <table id="tabla-productos" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th style="min-width: 35px; max-width: 35px;">ID</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Imagen</th>
                    <th style="max-width: 120px;">Accion</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productos as $producto)
                    <tr>
                        <td>{{ $producto->id }}</td>
                        <td>{{ $producto->nombre }}</td>
                        <td>{{ $producto->descripcion ? $producto->descripcion : '' }}</td> <!-- Modificación aquí -->
                        <td>${{ $producto->precio }}</td>
                        <td>{{ $producto->stock }}</td>
                        <td><img src="/restaurante-app/public/productos/{{ $producto->imagen }}" width="70px"
                                height="50px"></td>
                        <td>
                            <a title="Editar" href="producto/{{ $producto->id }}/edit" data-id="{{ $producto->id }}"
                                class="btn editar-producto btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></a>

                            <a title="Eliminar" href="producto/{{ $producto->id }}/delete" data-id="{{ $producto->id }}"
                                class="btn eliminar-producto btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@stop

@section('js')
    <script src="https://kit.fontawesome.com/18e24e909e.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <script>
        // Espera a que el DOM esté listo
        $(document).ready(function() {


            // Almacena una referencia al objeto DataTable en una variable
            var tablaProductos = $('#tabla-productos').DataTable({
                responsive: true,
                language: {
                    processing: "Traitement en cours...",
                    search: "Buscar",
                    lengthMenu: "Mostrar _MENU_ entradas",
                    info: "Pagina _START_ - _END_ de _TOTAL_ entradas",
                    infoEmpty: "Mostrando 0 de 0 de 0 entradas",
                    infoFiltered: "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                    infoPostFix: "",
                    loadingRecords: "Chargement en cours...",
                    zeroRecords: "No se encontraron resultados.",
                    emptyTable: "No se registraron productos hasta el momento",
                    paginate: {
                        first: "Premier",
                        previous: "Anterior",
                        next: "Siguiente",
                        last: "Dernier"
                    },
                    aria: {
                        sortAscending: ": activer para trier la colonne par ordre croissant",
                        sortDescending: ": activer para trier la colonne par ordre décroissant"
                    }
                }
            });

            // Función para cargar los datos de la tabla
            function recargarTabla() {
                $.ajax({
                    url: "{{ route('admin.todos.los.producto') }}",
                    type: "GET",
                    success: function(response) {
                        tablaProductos.clear().draw(); // Limpiar y dibujar la tabla

                        if (response.length > 0) {
                            response.forEach(function(producto) {
                                tablaProductos.row.add([
                                    producto.id,
                                    producto.nombre,
                                    producto.descripcion,
                                    '$' + producto.precio,
                                    producto.stock,
                                    '<img src="../productos/' + producto.imagen +
                                    '" width="70px" height="50px">',
                                    '<a title="Editar" style="margin-right: 5px" href="producto/' +
                                    producto.id + '/edit" data-id="' + producto.id +
                                    '" class="btn btn-primary editar-producto"><i class="fa fa-pencil" aria-hidden="true"></i></a>' +
                                    '<button title="Eliminar" class="btn btn-danger eliminar-producto" data-id="' +
                                    producto.id +
                                    '"><i class="fa fa-trash" aria-hidden="true"></i></button>'
                                ]).draw(false); // Agregar fila y dibujarla
                            });
                        } else{

                            tablaCategorias.clear().draw();
                            tablaCategorias.draw();

                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        // Manejar el error aquí
                    }
                });
            }

            // Mostrar formulario al crear un nuevo producto
            $('#mostrar-formulario').click(function() {

                Swal.fire({
                    title: 'Crear un nuevo producto',
                    html: `<form id="nuevo-producto-form" class="d-flex flex-column p-3 gap-2" method="POST" action="{{ route('admin.producto.store') }}" enctype="multipart/form-data">
                                @csrf
                                <label class="m-0 d-flex flex-column align-items-start justify-content-center" for="nombreProducto">*Nombre del Producto:</label>
                                <input type="text" class="form-control" id="nombreProducto" name="nombre">
                                <label class="m-0 d-flex flex-column align-items-start justify-content-center" for="descripcion">Descripción:</label>
                                <textarea class="form-control" id="descripcion" name="descripcion"></textarea>
                                <label class="m-0 d-flex flex-column align-items-start justify-content-center" for="precio">*Precio:</label>
                                <input type="number" class="form-control" id="precio" name="precio" step="0.01">
                                <label class="m-0 d-flex flex-column align-items-start justify-content-center" for="categoria">*Categoría:</label>
                                <select class="form-control" id="categoria" name="categoria">
                                    <option value="" disabled selected>Selecciona una categoria</option>
                                    @foreach ($categorias as $categoria)
                                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                    @endforeach
                                </select>
                                <label class="m-0 d-flex flex-column align-items-start justify-content-center" for="stock">Stock:</label>
                                <input type="number" class="form-control" id="stock" name="stock">
                                <label class="m-0 d-flex flex-column align-items-start justify-content-center" for="imagen">*Imagen:</label>
                                <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
                                <button id="guardar-producto-btn" type="button" class="btn btn-success">Guardar Producto</button>
                            </form>`,
                    showCancelButton: false,
                    showCloseButton: true,
                    showConfirmButton: false
                });

            });


            $(document).on('click', '#guardar-producto-btn', function() {

                var nombreProducto = $('#nombreProducto').val();
                var precioProducto = $('#precio').val();
                var categoriaProducto = $('#categoria').val();
                var imagenProducto = $('#imagen').val();

                // Realiza la petición AJAX para verificar si el nombre ya existe
                $.ajax({
                    url: '{{ route('admin.verificar.nombre.producto') }}',
                    method: 'POST',
                    data: {
                        nombre: nombreProducto,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {

                        if (nombreProducto === '' || precioProducto === '' ||
                            categoriaProducto === '' || imagenProducto === '') {

                            Swal.showValidationMessage('Los campos con (*) son obligatorios');

                        } else if (nombreProducto !== '' && (precioProducto === '' ||
                                categoriaProducto === '' || imagenProducto === '')) {} else if (
                            response.existe) {
                            Swal.fire('Error', '¡El producto ya existe!', 'error');
                        } else {
                            // Si el nombre del producto no existe, procede a guardar el producto
                            // Obtiene los datos del formulario
                            var formData = new FormData($('#nuevo-producto-form')[0]);

                            // Realiza la petición AJAX para guardar el producto
                            $.ajax({
                                url: '{{ route('admin.producto.store') }}',
                                method: 'POST',
                                data: formData,
                                processData: false,
                                contentType: false,
                                success: function(response) {

                                    recargarTabla();

                                    Swal.fire('Éxito', response.message, 'success');

                                },
                                error: function(xhr, status, error) {
                                    // Maneja los errores
                                    Swal.fire('Error',
                                        'Hubo un problema al guardar el producto.',
                                        'error');
                                }
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        // Maneja los errores de la solicitud AJAX de verificación de nombre
                        Swal.fire('Error',
                            'Hubo un problema al verificar el nombre del producto.', 'error'
                        );
                    }
                });
            });

            $(document).on('click', '.eliminar-producto', function(event) {
                event.preventDefault(); // Evitar el comportamiento predeterminado del evento de clic

                var productoId = $(this).data('id');
                var fila = $(this).closest('tr'); // Obtener la fila actual del producto

                // Mostrar un Swal.fire de confirmación antes de eliminar el producto
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: '¡No podrás revertir esto!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminarlo!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Si el usuario confirma la eliminación, realizar la solicitud AJAX para eliminar el producto
                        $.ajax({
                            url: '{{ route('admin.producto.delete', ['id' => ':productoId']) }}'.replace(':productoId', productoId), // Construir la URL correctamente
                            type: 'GET',
                            data: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                
                                fila.remove();

                                recargarTabla();

                                Swal.fire('Éxito', response.message, 'success');
                            },
                            error: function(xhr, status, error) {
                                
                                Swal.fire('Error', '¡Hubo un problema al eliminar el producto!', 'error');

                            }
                        });
                    }
                });
            });

            $(document).on('click', '.editar-producto', function(event) {

                var productoId = $(this).data('id');
                event.preventDefault();

                // Realiza una petición AJAX para obtener los datos del producto a editar
                $.ajax({
                    url: 'producto/' + productoId + '/edit',
                    method: 'GET',
                    success: function(response) {
                        
                        // Asigna los valores del producto al formulario de edición
                        $('#nombreProducto').val(response.nombre);
                        
                        // Verifica si la descripción es null y asigna un valor predeterminado en ese caso
                        if (response.descripcion !== null) {
                            $('#descripcion').val(response.descripcion);
                        } else {
                            $('#descripcion').val('');
                        }

                        $('#precio').val(response.precio);
                        $('#categoria').val(response.categoria);
                        $('#imagen').val(response.imagen);
                       
                        // Si el producto tiene una imagen, puedes mostrarla también
                        // Por ejemplo:
                        // $('#imagenPreview').attr('src', '/ruta/a/la/imagen/' + response.imagen);

                        // Muestra el modal de edición
                        Swal.fire({
                            title: 'Editar producto ID #' + productoId,
                            html: `<form id="editar-producto-form" class="d-flex flex-column p-3 gap-2" method="POST" action="update" enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <label class="m-0 d-flex flex-column align-items-start justify-content-center" for="nombreProducto">* Nombre del Producto:</label>
                                    <input type="text" class="form-control" id="nombreProducto" name="nombre" value="${response.nombre}" required>
                                    <label class="m-0 d-flex flex-column align-items-start justify-content-center" for="descripcion">Descripción:</label>
                                    <textarea class="form-control" id="descripcion" name="descripcion">${response.descripcion ?? ''}</textarea>
                                    <label class="m-0 d-flex flex-column align-items-start justify-content-center" for="precio">* Precio:</label>
                                    <input type="number" class="form-control" id="precio" name="precio" value="${response.precio}" step="0.01" required>
                                    <label class="m-0 d-flex flex-column align-items-start justify-content-center" for="categoria">* Categoría:</label>
                                    <select class="form-control" id="categoria" name="categoria" required>
                                        <option value="" disabled selected>Selecciona una categoria</option>
                                        @foreach ($categorias as $categoria)
                                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                        @endforeach
                                    </select>
                                    <label class="m-0 d-flex flex-column align-items-start justify-content-center" for="stock">Stock:</label>
                                    <input type="number" class="form-control" id="stock" value="${response.stock}" name="stock">
                                    <label class="m-0 d-flex flex-column align-items-start justify-content-center" for="imagen">* Imagen:</label>
                                    <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*" value="${response.imagen}" required>
                                    <button type="button" id="editar-producto-btn" class="btn btn-success">Guardar cambios</button>
                                    </form>`,
                            showCancelButton: false,
                            showCloseButton: true,
                            showConfirmButton: false
                        });
                    },
                    error: function(xhr, status, error) {
                        // Maneja los errores
                        console.error(error);
                        Swal.fire('Error', 'Hubo un problema al obtener los datos del producto.', 'error');
                    }
                });

                // Aquí se asigna el evento clic al botón de guardar dentro del modal
                $(document).off('click', '#editar-producto-btn').on('click', '#editar-producto-btn', function() {

                    var nombreProducto = $('#nombreProducto').val();
                    var descripcionProducto = $('#descripcion').val();
                    var precioProducto = $('#precio').val();
                    var categoriaProducto = $('#categoria').val();
                    var imagenProducto = $('#imagen').val();

                    // Validar los campos
                    if (nombreProducto === '' || precioProducto === '' || categoriaProducto === '' || imagenProducto === '') {
                        // Mostrar mensaje de error si algún campo requerido está vacío
                        Swal.showValidationMessage('Los campos con (*) son obligatorios');
                        return; // Detener la ejecución si hay campos vacíos
                    }

                    var formData = new FormData($('#editar-producto-form')[0]);

                    // Realiza la petición AJAX para guardar el producto
                    $.ajax({
                        url: 'producto/'+productoId+'/update',
                        method: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}' // Incluye el token CSRF en el encabezado de la solicitud
                        },
                        success: function(response) {

                            recargarTabla();

                            Swal.fire('Éxito', response.message, 'success');

                        },
                        error: function(xhr, status, error) {
                            // Maneja los errores
                            Swal.fire('Error',
                                'Hubo un problema al guardar el producto.',
                                'error');
                            console.log(error);
                        }
                    });

                });

            });

        });
    </script>

@stop
