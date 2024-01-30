<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf;
use App\Models\Pedidos;
use App\Models\Productos;
use App\Models\OrderItem;
use App\Models\PedidosEntregados;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;

class FpdfController extends Controller
{
    protected $fpdf;

    
    public function index($orderId) {

        // Obtener el pedido para el usuario con el ID especificado
        $cajero = auth()->user()->name;
        $detalle_pedido = OrderItem::select('nombre', 'cantidad', 'precio')
        ->where('pedido_id', $orderId)
        ->get();
        $pedido = OrderItem::where('pedido_id', $orderId)->first();
        $fecha = OrderItem::where('pedido_id', $orderId)->value("created_at");
        $total = Pedidos::where('id', $orderId)->value("total");
        
        // Verificar si se encontró el pedido
        if ($pedido) {
            // Obtener el valor de la columna deseada, por ejemplo, 'detalle'
            $nro_pedido = OrderItem::where('pedido_id', $orderId)->value("pedido_id");
            // $cantidad_pedido = OrderItem::where('id', $orderId)->value("cantidad");
            // $total_producto = Pedidos::where('id', $orderId)->value("total");
            // $nombre_producto = OrderItem::where('id', $orderId)->value("nombre");
            // $precio_producto = Productos::where('id', $idPedido)->value("precio");
            
        } else {
            // El usuario no tiene ningún pedido
            echo "El usuario no tiene pedidos.";
        }

        // $resultado ahora contiene los resultados de la consulta
        
        if (!$nro_pedido) {
            abort(404, 'Pedido no encontrado');
        }

        // $cantidad = DB::table('order_items')->where('id',$orderId)->value("cantidad");
        // $producto = DB::table('productos')->where('id',$orderId)->value("nombre");
        // $precio = DB::table('productos')->where('id',$orderId)->value("precio");
        // $total = DB::table('pedidos')->where('id',$orderId)->value("total");
        $this->fpdf = new Fpdf('P','mm',array(80,150));
        $this->fpdf->AddPage();
        $this->fpdf->SetMargins(5,5,5);
        
        $this->fpdf->Image("images/preloader.png", 30, 3, 20,);
        
        $this->fpdf->SetFont('Arial', 'B', 12);
        $this->fpdf->Ln(15);
        $this->fpdf->MultiCell(70, 5, 'Mi restaurante', 0, 'C');

        $this->fpdf->Ln(3);
        $this->fpdf->SetFont('Arial', 'B', 8);
        $this->fpdf->Cell(15,5, mb_convert_encoding('Número de pedido: ','ISO-8859-1','UTF-8')."00".$nro_pedido,0,0,'L');

        $this->fpdf->Ln(5);
        $this->fpdf->Cell(10,4,'Cajero: '.$cajero, 0, 0, 'L');
        
        $this->fpdf->Ln(5);
        $this->fpdf->SetFont('Arial', '', 8);
        $this->fpdf->Cell(70, 2, '-----------------------------------------------------------------------------------', 0, 1, 'C');
        
        $this->fpdf->Cell(10,4,'Cant.', 0, 0, 'L');
        $this->fpdf->Cell(30,4,'Producto', 0, 0, 'L');
        $this->fpdf->Cell(20,4,'Precio x/u', 0, 0, 'L');
        $this->fpdf->Cell(20,4,'Total', 0, 0, 'L');
        $this->fpdf->Ln(4);
        $this->fpdf->Cell(70, 2, '-----------------------------------------------------------------------------------', 0, 1, 'C');

        $this->fpdf->SetFont('Arial', '', 7);

        foreach ($detalle_pedido as $detalle) {
            $importe = $detalle->precio * $detalle->cantidad;
            $importe = number_format($importe,0,'.',',');

            $this->fpdf->Cell(10,4,$detalle->cantidad, 0, 0, 'L');

            $yInicio = $this->fpdf->GetY();
            $this->fpdf->MultiCell(30,4, mb_convert_encoding($detalle->nombre,'ISO-8859-1','UTF-8'),0,'L');
            $yFin = $this->fpdf->GetY();

            $this->fpdf->SetXY(45, $yInicio);

            $this->fpdf->Cell(20,4,'$'.number_format($detalle->precio,0,'.',','), 0, 0, 'L');
            $this->fpdf->Cell(20,4,'$'.$importe, 0, 0, 'L');
            $this->fpdf->Ln(4);

            $this->fpdf->SetY($yFin);
            
        }

        $this->fpdf->Cell(70, 2, '-----------------------------------------------------------------------------------------------', 0, 1, 'C');
        $this->fpdf->SetFont('Arial', '', 7);
        $this->fpdf->MultiCell(70, 5, 'BASE Imp  I.V.A incluido 10%', 0, 'L');
        $this->fpdf->Cell(70, 2, '-----------------------------------------------------------------------------------------------', 0, 1, 'C');

        $this->fpdf->Ln(2);
        $this->fpdf->SetFont('Arial', 'B', 8);
        $this->fpdf->Cell(10,4,'Total:'."                                                               $".$total, 0, 0, 'L');

        $this->fpdf->SetFont('Arial', '', 8);
        $this->fpdf->Ln(5);
        $this->fpdf->Cell(10,4,"Fecha:                                         ".$fecha, 0, 0, 'L');

        $this->fpdf->Ln(5);
        $this->fpdf->MultiCell(70, 5, '!Gracias por su compra!', 0, 'C');

        $this->fpdf->Output();
        exit;

    }

}
