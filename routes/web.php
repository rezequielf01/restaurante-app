<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\AdminHomeController;
use App\Http\Controllers\AdminPedidosController;
use App\Http\Controllers\AdminHamburgesasController;
use App\Http\Controllers\AdminBebidasController;
use App\Http\Controllers\AdminUsuariosController;
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

Route::post('carrito/add', [CarritoController::class, 'add'])->name('carrito.add');
Route::get('carrito/checkout', [CarritoController::class, 'checkout'])->name('carrito.checkout');
Route::get('carrito/clear', [CarritoController::class, 'clear'])->name('carrito.clear');
Route::post('carrito/delete-item', [CarritoController::class, 'deleteItem'])->name('carrito.delete.item');
Route::post('carrito/enviar-pedido', [CarritoController::class, 'sendOrder'])->name('carrito.enviar.pedido');
Route::get('carrito/incrementar/{id}', [CarritoController::class, 'incrementarCantidad']);
Route::get('carrito/restar/{id}', [CarritoController::class, 'restarCantidad']);


Route::get('admin/pedidos', [AdminPedidosController::class, 'show'])->middleware("can:admin.pedidos")->name('admin.pedidos');
Route::get('admin/pedidos/{id}/delete', [AdminPedidosController::class, 'destroy'])->name('admin.pedido.delete');

Route::get('admin/crear-producto', [ProductosController::class, 'create'])->middleware("can:admin.crear.producto")->name('admin.crear.producto');
Route::post('admin/producto/store', [ProductosController::class, 'store'])->middleware("can:admin.producto.store")->name('admin.producto.store');
Route::get('admin/productos/{id}/edit', [ProductosController::class, 'edit'])->middleware("can:admin.producto.edit")->name('admin.producto.edit');
Route::put('admin/productos/{id}/update', [ProductosController::class, 'update'])->middleware("can:admin.producto.update")->name('admin.producto.update');
Route::get('admin/productos/{id}/delete', [ProductosController::class, 'destroy'])->middleware("can:admin.producto.delete")->name('admin.producto.delete');

Route::get('admin/productos/hamburgesas', [AdminHamburgesasController::class, 'show'])->middleware("can:admin.productos.hamburgesas")->name('admin.productos.hamburgesas');
Route::get('admin/productos/bebidas', [AdminBebidasController::class, 'show'])->middleware("can:admin.productos.bebidas")->name('admin.productos.bebidas');
Route::get('admin/usuarios-registrados', [AdminUsuariosController::class, 'show'])->middleware("can:admin.usuarios")->name('admin.usuarios');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('admin', [AdminHomeController::class, 'index'])->middleware("can:admin.home")->name('admin.home');
});

