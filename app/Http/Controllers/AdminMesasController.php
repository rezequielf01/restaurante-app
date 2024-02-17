<?php

namespace App\Http\Controllers;

use App\Models\DetalleVentaLocal;
use App\Models\Mesas;
use App\Models\Productos;
use App\Models\MesasProductos;
use App\Models\VentasLocal;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\alert;

class AdminMesasController extends Controller
{

    public function show()
    {

        $mesas = DB::select('SELECT * from mesas');
        return view("admin.mesas", compact("mesas"));
    }

    public function calcularTotalMesa($mesaId)
    {
        $total = 0;
        $productos_en_mesa = MesasProductos::where('mesas_id', $mesaId)->get();

        foreach ($productos_en_mesa as $producto) {
            // Acceder al precio del producto a través de la relación 'producto'
            $precioProducto = $producto->producto->precio;
            $cantidadProducto = $producto->producto_cantidad;

            // Calcular el precio total del producto y sumarlo al total de la mesa
            $total += $precioProducto * $cantidadProducto;
        }
        return $total;
    }

    public function agregarMesa(Request $request)
    {

        try {
            // Código para agregar una nueva mesa
            $nuevaMesa = new Mesas();
            $nuevaMesa->nro_mesa = $request->input('campo1');
            $nuevaMesa->capacidad = $request->input('campo2');
            // Otros campos
            $nuevaMesa->save();
    
            return response()->json(['mensaje' => '¡Mesa agregada correctamente!']);
        } catch (QueryException $e) {
            // Si se produce una excepción de integridad de base de datos (por ejemplo, número de mesa duplicado), manejarla aquí
            return response()->json(['error' => 'El número de mesa ya está en uso'], 400);
        }
    }

    public function eliminarMesa(Request $request)
    {
        // Obtener el ID de la mesa que se va a eliminar
        $mesaId = $request->input('mesa_id');

        // Lógica para eliminar la mesa de la base de datos
        $mesa = Mesas::find($mesaId);
        if ($mesa) {
            $mesa->delete();
            return response()->json(['mensaje' => 'Mesa eliminada correctamente']);
        } else {
            return response()->json(['mensaje' => 'No se pudo encontrar la mesa'], 404);
        }
    }

    public function administrar($mesaId)
    {

        $mesa = Mesas::find($mesaId);
        $productos = DB::select('SELECT * FROM productos');
        $cantidadVentas = VentasLocal::all();
        $categorias = DB::select('SELECT * FROM categorias');
        $total = $this->calcularTotalMesa($mesaId);

        // Obtener la última venta asociada a la mesa
        if (VentasLocal::all()->count() > 0) {

            $ventaId = VentasLocal::orderBy('id', 'desc')->value('id');
        } else {
            $ventaId = 0;
        }

        // Si quieres devolver una vista
        return view("admin.administrar-mesa", compact("mesa", "productos", "categorias", "total", "ventaId"));
    }

    public function agregarProducto($mesaId)
    {
        $mesa = Mesas::where("id", $mesaId)->first();
        $productos = Productos::all();
        $categorias = DB::select('SELECT nombre FROM categorias');

        return view("admin.administrar-mesa", compact("mesa", "productos", "categorias"));
    }

    public function guardarProducto(Request $request, $mesaId)
    {
        $mesa = Mesas::findOrFail($mesaId);
        $producto_id = $request->productoId;
        $cantidad = $request->cantidad;
        $producto_mesa = MesasProductos::select('producto_cantidad')->where('mesas_id', $mesaId)->where('productos_id', $producto_id)->first();

        if ($cantidad == "") {
            $cantidad = 1;
        }

        if (!$producto_mesa && $cantidad >= 1) {

            MesasProductos::create([
                'mesas_id' => $mesaId,
                'productos_id' => $producto_id,
                'producto_cantidad' => $cantidad,
            ]);

            return redirect()->route('admin.ver.mesa', ['mesaId' => $mesa->id])->with('success', 'Producto agregado');
        } elseif (!$producto_mesa && $cantidad <= 0) {
            echo "Pruebe con un numero mayor a 0";
        } elseif ($producto_mesa && $producto_mesa->producto_cantidad > 0 && $cantidad >= 1) {

            MesasProductos::where('productos_id', $producto_id)->increment('producto_cantidad', $cantidad);
            return redirect()->route('admin.ver.mesa', ['mesaId' => $mesa->id])->with('success', 'Producto agregado');
        } elseif ($producto_mesa && $producto_mesa->producto_cantidad > 0 && $cantidad <= 0) {
            echo "Pruebe con un numero mayor a 0";
        }
    }

    public function restarCantidad(Request $request, $mesaId)
    {
        $mesa = Mesas::findOrFail($mesaId);
        $producto_id = $request->productoId;
        $cantidad2 = $request->cantidad2;
        $producto_mesa = MesasProductos::select('producto_cantidad')->where('mesas_id', $mesaId)->where('productos_id', $producto_id)->first();

        if ($cantidad2 == "") {
            $cantidad2 = 1;
        }

        if ($producto_mesa->producto_cantidad > 0) {
            // Si la cantidad es mayor que cero, decrementamos la cantidad.
            MesasProductos::where('productos_id', $producto_id)->where('mesas_id',$mesaId)->decrement('producto_cantidad', $cantidad2);

            // Verificamos si la cantidad ha llegado a cero y eliminamos el producto si es el caso.
            $producto_mesa = MesasProductos::select('producto_cantidad')->where('mesas_id', $mesaId)->where('productos_id', $producto_id)->first();

            if ($producto_mesa->producto_cantidad <= 0) {
                MesasProductos::where('productos_id', $producto_id)->where('mesas_id',$mesaId)->delete();
                return redirect()->route('admin.ver.mesa', ['mesaId' => $mesa->id])->with('productoEliminado', 'Producto eliminado');
            } else {
                return redirect()->route('admin.ver.mesa', ['mesaId' => $mesa->id])->with('productoRestado', 'Producto restado');
            }
        } else {
            // Si la cantidad es igual o menor a cero, eliminamos el producto y terminamos la función.
            MesasProductos::where('productos_id', $producto_id)->where('mesas_id',$mesaId)->delete();
            return redirect()->route('admin.ver.mesa', ['mesaId' => $mesa->id])->with('productoEliminado', 'Producto eliminado');
        }
    }

    public function cerrarMesa(Request $request, $mesaId)
    {

        $mesa = Mesas::findOrFail($mesaId);

        $venta = new VentasLocal();

        $venta->cajero = $request->cajero;
        $venta->cliente = $request->cliente;
        $venta->forma_de_pago = $request->medioDePago;
        $venta->total = $request->total;

        if ($venta->total > 0) {
            $venta->save();
            $ventaId = $venta->id;

            foreach ($mesa->productos as $item) {
                DetalleVentaLocal::create([
                    'mesa_nro' => $mesa->nro_mesa,
                    'venta_id' => $ventaId,
                    'producto_id' => $item->id,
                    'nombre' => $item->nombre,
                    'cantidad' => $item->pivot->producto_cantidad,
                    'precio' => $item->precio,
                ]);
            }

            MesasProductos::where('mesas_id', $mesaId)->delete();

            DB::commit();

            return back()->with('mesaLiberada','¡Mesa liberada!');
        } else {
            echo "ERROR AL CERRAR MESA";
            db::rollBack();
        }
    }
}
