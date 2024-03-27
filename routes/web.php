<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\AdminHomeController;
use App\Http\Controllers\AdminPedidosController;
use App\Http\Controllers\AdminMesasController;
use App\Http\Controllers\AdminUsuariosController;
use App\Http\Controllers\AdminVentasLocalController;
use App\Http\Controllers\FpdfController;
use App\Http\Controllers\FpdfDeliveredController;
use App\Http\Controllers\FpdfVentasController;
use App\Http\Controllers\ProductosController;
use Illuminate\Routing\RouteGroup;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('home', [HomeController::class, 'index'])->name('home');
Route::get('menu', [MenuController::class, 'index'])->name('menu');

Route::get('usuario/perfil', [UserController::class, 'index'])->name('usuario.perfil');
// Route::get('usuario/pedidos', [UserController::class, 'index'])->name('usuario.pedidos');

// PAGINAS
Route::get('carrito/checkout', [CarritoController::class, 'checkout'])->name('carrito.checkout');
// ACCIONES
Route::post('carrito/buy', [CarritoController::class, 'buy'])->name('carrito.buy');
Route::post('carrito/add', [MenuController::class, 'add'])->name('carrito.add');
Route::get('carrito/clear', [CarritoController::class, 'clear'])->name('carrito.clear');
Route::get('carrito/incrementar/{id}', [CarritoController::class, 'incrementarCantidad']);
Route::get('carrito/restar/{id}', [CarritoController::class, 'restarCantidad']);
Route::post('carrito/delete-item', [CarritoController::class, 'deleteItem'])->name('carrito.delete.item');
Route::get('carrito/obtener-total', [CarritoController::class, 'obtenerTotal'])->name('carrito.total');
Route::post('carrito/enviar-pedido', [CarritoController::class, 'sendOrder'])->name('carrito.enviar.pedido');


// PAGINAS
Route::get('admin', [AdminHomeController::class, 'show'])->middleware("can:admin.home")->name('admin.home');
Route::get('admin/mesas', [AdminHomeController::class, 'mostrarMesas'])->name('admin.mesas');
Route::get('admin/administrar/mesas/{mesaId}', [AdminMesasController::class, 'administrar'])->name('admin.ver.mesa');
Route::get('admin/administrar/obtener-productos-mesa/{mesaId}', [AdminMesasController::class, 'obtenerProductosEnMesa'])->name('admin.productos.en.mesa');
// Route::get('admin/administrar/mesas/{mesaId}/agregar-producto', [AdminMesasController::class, 'guardarProducto'])->name('admin.guardar.producto.mesa');
// ACCIONES
Route::post('admin/administrar/mesas/{mesaId}/agregar', [AdminMesasController::class, 'agregarProducto'])->name('admin.agregar.producto.mesa');
Route::post('admin/eliminar/mesa', [AdminMesasController::class, 'eliminarMesa'])->name('admin.eliminar.mesa');
Route::post('admin/administrar/mesas/{mesaId}/guardar-producto', [AdminMesasController::class, 'guardarProducto'])->name('admin.guardar.producto.mesa');
Route::post('admin/enviar-formulario', [AdminMesasController::class, 'agregarMesa'])->name('admin.agregar.mesa.btn');
Route::get('admin/administrar/mesas/{mesaId}/restar-producto', [AdminMesasController::class, 'restarCantidad'])->name('admin.restar.producto.mesa');
Route::post('admin/administrar/mesas/{mesaId}/cerrar-mesa', [AdminMesasController::class, 'cerrarMesa'])->name('admin.cerrar.mesa');
Route::get('admin/administrar/mesas/ticket/{ventaId}', [FpdfController::class, 'ventaLocal'])->name('admin.fpdf.venta.local');
Route::get('admin/administrar/mesas/ticket/{ventaId}', [FpdfVentasController::class, 'ventaLocal'])->name('admin.fpdf.venta.local');

// PAGINAS
Route::get('admin/pedidos', [AdminPedidosController::class, 'show'])->middleware("can:admin.pedidos")->name('admin.pedidos');
Route::get('admin/todos/los/pedidos', [AdminPedidosController::class, 'filtrarTodosLosPedidos'])->name('admin.todos.los.pedidos.pendientes');
Route::get('admin/todos/los/pedidos/entregados', [AdminPedidosController::class, 'filtrarTodosLosPedidosEntregados'])->name('admin.todos.los.pedidos.entregados');
Route::get('admin/pedidos-entregados', [AdminPedidosController::class, 'ordersDelivered'])->middleware("can:admin.pedidos.entregados")->name('admin.pedidos.entregados');
// ACCIONES
Route::post('admin/pedidos/{id}/entregado', [AdminPedidosController::class, 'orderMoved'])->name('admin.pedido.entregado');
Route::get('admin/pedidos/{id}/cancelado', [AdminPedidosController::class, 'destroy'])->name('admin.pedido.cancelado');

Route::get('admin/ticket/{orderId}', [FpdfController::class, 'index'])->name('admin.fpdf');
Route::get('admin/ticket/nro/{orderId}', [FpdfDeliveredController::class, 'index'])->name('admin.fpdf.delivered');

Route::get('admin/ventas-en-local', [AdminVentasLocalController::class, 'show'])->name('admin.ventas.local');
// Route::get('admin/ventas-en-local/{id}', [AdminVentasLocalController::class, 'showw'])->name('admin.ventas.local');

Route::get('admin/categorias', [ProductosController::class, 'showCategorias'])->name('admin.categorias');
Route::get('admin/agregar-categoria', [ProductosController::class, 'agregarATablaCategoria'])->name('admin.tabla.categoria');
Route::post('admin/categoria/store', [ProductosController::class, 'subirCategoria'])->name('admin.categoria.store');
Route::get('admin/categoria/{id}/delete', [ProductosController::class, 'eliminarCategoria'])->name('admin.categoria.delete');

Route::get('filtrar-productos/{categoria_id}', [ProductosController::class, 'filtrarPorCategoria'])->name('admin.filtrar.producto');
Route::get('todos-los-productos', [ProductosController::class, 'filtrarTodosLosProductos'])->name('admin.todos.los.producto');

Route::get('todos', [MenuController::class, 'all'])->name('menu.todos');
Route::get('{categoria}', [MenuController::class, 'categories'])->name('menu.categorias');
Route::get('productos/categoria/{id}', [MenuController::class, 'categories'])->name('menu.categorias');
Route::post('user/cambiar-direccion', [MenuController::class, 'cambiarDireccion'])->name('cliente.actualizar.direccion');

Route::get('admin/productos', [ProductosController::class, 'show'])->name('admin.productos');

Route::post('admin/verificar-nombre-producto', [ProductosController::class, 'verificarNombreProducto'])->name('admin.verificar.nombre.producto');
Route::get('admin/crear-producto', [ProductosController::class, 'crearProducto'])->middleware("can:admin.crear.producto")->name('admin.crear.producto');
Route::post('admin/producto/store', [ProductosController::class, 'subirProducto'])->middleware("can:admin.producto.store")->name('admin.producto.store');
Route::get('admin/producto/{id}/edit', [ProductosController::class, 'edit'])->middleware("can:admin.producto.edit")->name('admin.producto.edit');
Route::put('admin/producto/{id}/update', [ProductosController::class, 'update'])->middleware("can:admin.producto.update")->name('admin.producto.update');
Route::get('admin/producto/{id}/delete', [ProductosController::class, 'eliminarProducto'])->middleware("can:admin.producto.delete")->name('admin.producto.delete');


Route::get('admin/usuarios-registrados', [AdminUsuariosController::class, 'show'])->middleware("can:admin.usuarios")->name('admin.usuarios');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('admin', [AdminHomeController::class, 'index'])->middleware("can:admin.home")->name('admin.home');
});

