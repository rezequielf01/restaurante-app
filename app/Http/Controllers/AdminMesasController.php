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

    public function obtenerProductosEnMesa($mesaId){
        $mesa = Mesas::findOrFail($mesaId);
        $productos = $mesa->productos; // Suponiendo que tienes una relación entre Mesa y Producto
    
        // Obtener la cantidad de cada producto en la mesa
        foreach ($productos as $producto) {
            $producto->cantidad = $producto->pivot->producto_cantidad;
        }

        $totalMesa = $this->calcularTotalMesa($mesaId);

        return response()->json(['productos' => $productos, 'total' => number_format($totalMesa,3,'.',',')]);
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

             // Crear el nuevo registro en la tabla MesasProductos
            MesasProductos::create([
                'mesas_id' => $mesaId,
                'productos_id' => $producto_id,
                'producto_cantidad' => $cantidad,
            ]);

            $mensaje = 'El producto se agregó a la mesa';

            $totalMesa = $this->calcularTotalMesa($mesaId); // Sumar el precio de todos los productos en la mesa

            return response()->json(['mensaje' => $mensaje, 'total' => number_format($totalMesa,3,'.',',')]);

        } elseif (!$producto_mesa && $cantidad <= 0) {

            $mensaje = 'Ingrese un número mayor a 0';

            $totalMesa = $this->calcularTotalMesa($mesaId);

            return response()->json(['mensaje' => $mensaje, 'total' => number_format($totalMesa,3,'.',',')]);

        } elseif ($producto_mesa && $producto_mesa->producto_cantidad > 0 && $cantidad >= 1) {

            MesasProductos::where('productos_id', $producto_id)->increment('producto_cantidad', $cantidad);

            $mensaje = 'El producto se sumó a la mesa';

            $totalMesa = $this->calcularTotalMesa($mesaId); // Sumar el precio de todos los productos en la mesa

            return response()->json(['mensaje' => $mensaje, 'total' => number_format($totalMesa,3,'.',',')]);

        } elseif ($producto_mesa && $producto_mesa->producto_cantidad > 0 && $cantidad <= 0) {

            $mensaje = 'Ingrese un número mayor a 0';

            $totalMesa = $this->calcularTotalMesa($mesaId);

            return response()->json(['mensaje' => $mensaje, 'total' => number_format($totalMesa,3,'.',',')]);
            
        }
    
    }

    public function restarCantidad(Request $request, $mesaId)
    {

        // Validar datos de entrada
        $request->validate([
            'productoId' => 'required|numeric',
            'cantidad2' => 'nullable|numeric',
        ]);

        $producto_id = $request->productoId;
        $cantidad2 = $request->cantidad2 ?? 1; //SI EL REQUEST ESTA VACIO EL VALOR ES 1

        // Obtener y actualizar la cantidad del producto en la mesa
        $mesaProducto = MesasProductos::where('mesas_id', $mesaId)
                                        ->where('productos_id', $producto_id)
                                        ->firstOrFail();

        $nuevaCantidad = max(0, $mesaProducto->producto_cantidad - $cantidad2);
        $mesaProducto->update(['producto_cantidad' => $nuevaCantidad]);

        $totalMesa = $this->calcularTotalMesa($mesaId);

        // Eliminar el producto si la cantidad llega a cero
        if ($nuevaCantidad <= 0) {
            $mesaProducto->delete();
            return response()->json(['mensaje' => '¡Producto eliminado!', 'total' => number_format($totalMesa,3,'.',',')]);
        }

        // Redireccionar con un mensaje de éxito
        return response()->json(['mensaje' => '¡Producto restado!', 'total' => number_format($totalMesa,3,'.',',')]);

    }

    public function cerrarMesa(Request $request, $mesaId)
    {

        $mesa = Mesas::findOrFail($mesaId);

        // Inicializar el total de la venta en cero
        $totalVenta = 0;
    
        foreach ($mesa->productos as $item) {
            // Calcular el total de la venta sumando el precio de cada producto
            $totalVenta += $item->precio * $item->pivot->producto_cantidad;
        }
    
        // Verificar si el total de la venta es mayor que cero
        if ($totalVenta > 0) {
            // Crear una nueva instancia de VentasLocal solo si hay productos en la mesa
            $venta = new VentasLocal();
    
            $venta->cajero = $request->cajero;
            $venta->cliente = $request->cliente;
            $venta->forma_de_pago = $request->medioDePago;
            $venta->total = $totalVenta; // Asignar el total de la venta calculado
    
            // Guardar la venta en la base de datos
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
    
            // Eliminar los productos de la mesa
            MesasProductos::where('mesas_id', $mesaId)->delete();
    
            // Realizar un commit de la transacción
            DB::commit();
    
            return back()->with('mesaLiberada', '¡Mesa liberada!');
        } else {
            // Si no hay productos en la mesa, mostrar un mensaje de error
            return back()->withErrors(['mensaje' => 'No se encontraron productos en la mesa.']);
        }
    }
}
