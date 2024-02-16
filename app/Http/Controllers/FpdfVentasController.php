<?php

namespace App\Http\Controllers;

use App\Models\DetalleVentaLocal;
use App\Models\VentasLocal;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf;

class FpdfVentasController extends Controller
{
    protected $fpdf;

    public function ventaLocal($ventaId) {
        
        // Obtener el pedido para el usuario con el ID especificado
        $cajero = auth()->user()->name;
        $detalle_pedido = DetalleVentaLocal::where('venta_id', $ventaId)->get();
        $venta = DetalleVentaLocal::where('venta_id', $ventaId)->first();
        $fecha = DetalleVentaLocal::where('venta_id', $ventaId)->value("created_at");
        $total = VentasLocal::where('id', $ventaId)->value("total");
        $mesa_nro = DetalleVentaLocal::where('venta_id', $ventaId)->value("mesa_nro");
        
        // Verificar si se encontró el pedido
        if ($venta) {
            // Obtener el valor de la columna deseada, por ejemplo, 'detalle'
            $nro_venta = DetalleVentaLocal::where('venta_id', $ventaId)->value("venta_id");
            
        } else {
            // El usuario no tiene ningún pedido
            echo "El usuario no tiene pedidos.";
        }
 
        // $resultado ahora contiene los resultados de la consulta
        
        if (!$nro_venta) {
            abort(404, 'Pedido no encontrado');
        }
 
        $this->fpdf = new Fpdf('P','mm',array(80,150));
        $this->fpdf->AddPage();
        $this->fpdf->SetMargins(5,5,5);
        
        $this->fpdf->Image("images/preloader.png", 30, 3, 20,);
        
        $this->fpdf->SetFont('Arial', 'B', 12);
        $this->fpdf->Ln(15);
        $this->fpdf->MultiCell(70, 5, 'Mi restaurante', 0, 'C');
 
        $this->fpdf->Ln(3);
        $this->fpdf->SetFont('Arial', 'B', 8);
        $this->fpdf->Cell(15,5, mb_convert_encoding('Número de venta: ','ISO-8859-1','UTF-8')."00".$nro_venta,0,0,'L');
 
        $this->fpdf->Ln(5);
        $this->fpdf->Cell(10,4,'Cajero: '.$cajero, 0, 0, 'L');
        $this->fpdf->MultiCell(50, 4, 'Mesa Nro: '.$mesa_nro, 0, 'R');
        
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
            $importe = number_format($importe,3,'.',',');
 
            $this->fpdf->Cell(10,4,$detalle->cantidad, 0, 0, 'L');
 
            $yInicio = $this->fpdf->GetY();
            $this->fpdf->MultiCell(30,4, mb_convert_encoding($detalle->nombre,'ISO-8859-1','UTF-8'),0,'L');
            $yFin = $this->fpdf->GetY();
 
            $this->fpdf->SetXY(45, $yInicio);
 
            $this->fpdf->Cell(20,4,'$'.number_format($detalle->precio,3,'.',','), 0, 0, 'L');
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
