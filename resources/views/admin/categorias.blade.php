@extends('adminlte::page')

@section('title', 'Lista de pedidos')

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="{{ asset('/css/index.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/responsive.css') }}" rel="stylesheet">
@stop

@section('content_header')
    <div class="admin-header">
        <span class="admin-title-header__span">
            <img class="admin-title-header__img" src="../images/categoria.png" alt="Pedido png">
        </span>
        <h2 class="admin-title-header__h2">Lista de categorias</h2>
    </div>
@stop

@section('content')

    @if (session('success'))
        <div class="alert alert-success alert-block">
            <strong>{{ session('success') }}</strong>
        </div>
    @endif

    <button id="btnNuevaCategoria" class="btn bg-danger p-2 rounded" style="margin-bottom: 15px"><i
            class="fa fa-plus-circle" aria-hidden="true"></i> Nueva categoria</button>

    <div class="bg-light shadow-lg p-3">
        <table id="tabla-categorias" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th style="min-width: 35px; max-width: 35px;">ID</th>
                    <th>Nombre</th>
                    <th>Icono</th>
                    <th style="max-width: 120px;">Accion</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categorias as $categoria)
                    <tr>
                        <td>{{ $categoria->id }}</td>
                        <td>{{ $categoria->nombre }}</td>
                        <td><img src="../productos/{{ $categoria->icono }}" width="50px" height="50px"></td>
                        <td>
                            <button title="Eliminar" id="eliminar-categoria" data-id="{{ $categoria->id }}" class="btn btn-danger" id="asd"><i
                                    class="fa fa-trash" aria-hidden="true"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    

@stop

@section('js')
    <script src="https://kit.fontawesome.com/18e24e909e.js" crossorigin="anonymous"></script>



    <script>
        $(document).ready(function() {

            // Almacena una referencia al objeto DataTable en una variable
            var tablaCategorias = $('#tabla-categorias').DataTable({
                responsive: true,
                language: {
                    processing: "Traitement en cours...",
                    search: "Buscar",
                    lengthMenu: "Mostrar _MENU_ entradas",
                    info: "Pagina _START_ de _END_ de _TOTAL_ entradas",
                    infoEmpty: "Mostrando 0 de 0 de 0 entradas",
                    infoFiltered: "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                    infoPostFix: "",
                    loadingRecords: "Chargement en cours...",
                    zeroRecords: "No se encontraron resultados.",
                    emptyTable: "No se registraron categorias hasta el momento",
                    paginate: {
                        first: "Premier",
                        previous: "Anterior",
                        next: "Siguiente",
                        last: "Dernier"
                    },
                    aria: {
                        sortAscending: ": activer pour trier la colonne par ordre croissant",
                        sortDescending: ": activer pour trier la colonne par ordre décroissant"
                    }
                }
            });

            function recargarTabla() {
                $.ajax({
                url: "{{ route('admin.tabla.categoria') }}",
                type: "GET",
                success: function(response) {
                    tablaCategorias.clear().draw(); // Limpiar y dibujar la tabla
                    
                    if (response.length > 0) {
                        response.forEach(function(categoria) {
                            tablaCategorias.row.add([
                                categoria.id,
                                categoria.nombre,
                                '<img src="../productos/' + categoria.icono +
                                '" width="70px" height="50px">',
                                '<button title="Eliminar" id="eliminar-categoria" class="btn btn-danger" data-id="' +
                                categoria.id +
                                '"><i class="fa fa-trash" aria-hidden="true"></i></button>'
                            ]).draw(false); // Agregar fila y dibujarla
                        });
                    } else {
                        
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

            $('#btnNuevaCategoria').click(function() {

                Swal.fire({
                    title: '<i class="fa fa-plus-circle" aria-hidden="true"></i> Nueva categoría',
                    html: `
                        <form id="formNuevaCategoria" class="d-flex flex-column align-items-start justify-content-center p-3 gap-3 mb-3" enctype="multipart/form-data">
                            @csrf
                            <label class="m-0 d-flex flex-column align-items-start justify-content-center gap-2" for="nombreProducto">* Nombre de la categoría:
                                <input type="text" class="form-control bg-white shadow-lg" style="border: solid 1px gray" id="nombreCategoria" name="nombre" required>
                            </label>
    
                            <label class="m-0 d-flex flex-column align-items-start justify-content-center gap-2" for="imagen">* Icono:
                                <input type="file" class="form-control bg-white shadow-lg" style="border: solid 1px gray" id="imagen" name="icono" accept="image/*" required>
                            </label>
    
                            <div class="d-flex w-100 align-items-center justify-content-center" style="align-items: flex-end">
                                <button type="button" id="btnAgregarCategoria" class="btn ms-2 btn-success"><i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar categoría</button>
                            </div>
                        </form>`,
                    showCancelButton: false,
                    showCloseButton: true,
                    showConfirmButton: false
                });


                $('#btnAgregarCategoria').click(function() {
                    var formData = new FormData($('#formNuevaCategoria')[0]);

                    $.ajax({
                        url: "{{ route('admin.categoria.store') }}",
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            recargarTabla();
                            Swal.fire('¡Éxito!', response.success, 'success');
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);

                        }
                    });
                });

            });

            $(document).on('click', '#eliminar-categoria', function(event) {
                event.preventDefault(); // Evitar el comportamiento predeterminado del evento de clic

                var categoriaId = $(this).data('id');
                var fila = $(this).closest('tr'); // Obtener la fila actual del producto

                // Mostrar un Swal.fire de confirmación antes de eliminar la categoría
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
                        // Si el usuario confirma la eliminación, realizar la solicitud AJAX para eliminar la categoría
                        $.ajax({
                            url: '{{ route('admin.categoria.delete', ['id' => ':categoriaId']) }}'.replace(':categoriaId', categoriaId),
                            type: 'GET', // Cambiar el tipo de solicitud a POST
                            data: {
                                id: categoriaId, // Pasar el ID de la categoría a eliminar
                                _token: '{{ csrf_token() }}' // Pasar el token CSRF
                            },
                            success: function(response) {
                               
                                fila.remove();

                                recargarTabla();
                                
                                Swal.fire('¡Éxito!', response.message, 'success');

                            },
                            error: function(xhr, status, error) {
                                // Mostrar un Swal.fire de error si ocurre algún problema
                                Swal.fire('Error',
                                    '¡Hubo un problema al eliminar la categoría!',
                                    'error');
                            }
                        });
                    }
                });
            });


        });
    </script>

@stop
