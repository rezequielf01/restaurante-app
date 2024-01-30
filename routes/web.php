<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\AdminHomeController;
use App\Http\Controllers\AdminPedidosController;
use App\Http\Controllers\AdminComidasController;
use App\Http\Controllers\AdminHamburgesasController;
use App\Http\Controllers\AdminBebidasController;
use App\Http\Controllers\AdminCajaController;
use App\Http\Controllers\AdminUsuariosController;
use App\Http\Controllers\FpdfController;
use App\Http\Controllers\FpdfDeliveredController;
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
Route::post('carrito/add', [CarritoController::class, 'add'])->name('carrito.add');
Route::get('carrito/clear', [CarritoController::class, 'clear'])->name('carrito.clear');
Route::get('carrito/incrementar/{id}', [CarritoController::class, 'incrementarCantidad']);
Route::get('carrito/restar/{id}', [CarritoController::class, 'restarCantidad']);
Route::post('carrito/delete-item', [CarritoController::class, 'deleteItem'])->name('carrito.delete.item');
Route::get('carrito/obtener-total', [CarritoController::class, 'obtenerTotal'])->name('carrito.total');
Route::post('carrito/enviar-pedido', [CarritoController::class, 'sendOrder'])->name('carrito.enviar.pedido');

// PAGINAS
Route::get('admin/caja-registradora', [AdminCajaController::class, 'show'])->name('admin.caja');
// ACCIONES

// PAGINAS
Route::get('admin/pedidos-pendientes', [AdminPedidosController::class, 'show'])->middleware("can:admin.pedidos")->name('admin.pedidos');
Route::get('admin/pedidos-entregados', [AdminPedidosController::class, 'ordersDelivered'])->middleware("can:admin.pedidos.entregados")->name('admin.pedidos.entregados');
// ACCIONES
Route::get('admin/pedidos/{id}/entregado', [AdminPedidosController::class, 'orderMoved'])->name('admin.pedido.entregado');
Route::get('admin/pedidos/{id}/cancelado', [AdminPedidosController::class, 'destroy'])->name('admin.pedido.cancelado');

Route::get('admin/ticket/{orderId}', [FpdfController::class, 'index'])->name('admin.fpdf');
Route::get('admin/ticket/nro/{orderId}', [FpdfDeliveredController::class, 'index'])->name('admin.fpdf.delivered');

Route::get('admin/categorias', [ProductosController::class, 'showCategorias'])->name('admin.categorias');
Route::get('admin/crear-categoria', [ProductosController::class, 'crearCategoria'])->name('admin.crear.categoria');
Route::post('admin/categoria/store', [ProductosController::class, 'subirCategoria'])->name('admin.categoria.store');
Route::get('admin/categoria/{id}/delete', [ProductosController::class, 'destroyCategoria'])->name('admin.categoria.delete');

Route::get('admin/productos', [ProductosController::class, 'show'])->name('admin.productos');
Route::get('admin/crear-producto', [ProductosController::class, 'crearProducto'])->middleware("can:admin.crear.producto")->name('admin.crear.producto');
Route::post('admin/producto/store', [ProductosController::class, 'subirProducto'])->middleware("can:admin.producto.store")->name('admin.producto.store');
Route::get('admin/producto/{id}/edit', [ProductosController::class, 'edit'])->middleware("can:admin.producto.edit")->name('admin.producto.edit');
Route::put('admin/producto/{id}/update', [ProductosController::class, 'update'])->middleware("can:admin.producto.update")->name('admin.producto.update');
Route::get('admin/producto/{id}/delete', [ProductosController::class, 'destroy'])->middleware("can:admin.producto.delete")->name('admin.producto.delete');


Route::get('admin/usuarios-registrados', [AdminUsuariosController::class, 'show'])->middleware("can:admin.usuarios")->name('admin.usuarios');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('admin', [AdminHomeController::class, 'index'])->middleware("can:admin.home")->name('admin.home');
});

