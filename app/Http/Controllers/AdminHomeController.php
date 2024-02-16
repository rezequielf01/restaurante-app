<?php

namespace App\Http\Controllers;

use App\Models\IngresoMensual;
use App\Models\Mesas;
use App\Models\MesasProductos;
use App\Models\Pedidos;
use App\Models\PedidosEntregados;
use App\Models\User;
use App\Models\Productos;
use App\Models\VentasLocal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminHomeController extends Controller
{
    public function index(){
        $usuariosRegistrados = User::count();
        $productosRegistrados = Productos::count();
        $pedidosPendientes = Pedidos::count();
        $pedidosEntregados = PedidosEntregados::count();
        $ventasEnLocal = VentasLocal::count();

        $year = date('Y');
        $month = date('m');

        // Obtener el ingreso mensual de pedidos entregados
        $ingresoPedidosEntregados = PedidosEntregados::whereYear('create_time', '=', $year)
            ->whereMonth('create_time', '=', $month)
            ->sum('total');

        // Obtener el ingreso mensual de ventas locales
        $ingresoVentasLocales = VentasLocal::whereYear('created_at', '=', $year)
            ->whereMonth('created_at', '=', $month)
            ->sum('total');

        // Sumar los ingresos mensuales obtenidos
        $ingresoMensualTotal = $ingresoPedidosEntregados + $ingresoVentasLocales;

        // Buscar el registro de ingreso mensual para el año y mes actual
        $ingresoMensualExistente = IngresoMensual::where('año', date('Y'))
        ->where('mes', date('m'))
        ->first();

        // Si existe el registro, actualiza el ingreso total
        if ($ingresoMensualExistente) {
            $ingresoMensualExistente->update([
                'ingreso_total' => $ingresoMensualTotal,
            ]);
        } else {
        // Si no existe el registro, crea uno nuevo
        IngresoMensual::create([
            'año' => date('Y'),
            'mes' => date('m'),
            'ingreso_total' => $ingresoMensualTotal,
        ]);
        }

        $mesas = Mesas::all();
        
        return view("admin.home", compact("usuariosRegistrados","productosRegistrados",
        "pedidosPendientes","pedidosEntregados","ingresoMensualTotal","mesas","ventasEnLocal"));
    }

    public function mostrarMesas() {

        // Obtener lista de mesas de forma ordenada
        $mesas = Mesas::with('productos')->orderBy('nro_mesa')->get();

        return response()->json($mesas);
    }
}
