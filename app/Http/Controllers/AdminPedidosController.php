<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pedidos;
use App\Models\Productos;
use Gloudemans\Shoppingcart\Facades\Cart;
use Codedge\Fpdf\Fpdf\Fpdf;

class AdminPedidosController extends Controller
{
    
    protected $fpdf;
    
    public function ticket($id){
        $total = DB::table('pedidos')->where('id',$id)->value("total");
        $nro_pedido = DB::table('pedidos')->where('id',$id)->value("id");
        $pedido = DB::table('pedidos')->where('id',$id)->value("pedido");
        $this->fpdf = new Fpdf('P','mm',array(80,150));
        $this->fpdf->AddPage();
        $this->fpdf->SetMargins(5,5,5);
        $this->fpdf->SetFont('Arial', 'B', 9);

        $this->fpdf->Image("images/preloader.png", 30, 3, 20,);

        $this->fpdf->Ln(15);
        $this->fpdf->MultiCell(70, 5, 'Mi restaurante', 0, 'C');

        $this->fpdf->Ln(5);
        $this->fpdf->SetFont('Arial', 'B', 8);
        $this->fpdf->Cell(15,5, mb_convert_encoding('Número de pedido: ','ISO-8859-1','UTF-8')."00".$nro_pedido,0,0,'L');
        $this->fpdf->SetFont('Arial', '', 8);

        $this->fpdf->Ln(5);
        $this->fpdf->Cell(70, 2, '-----------------------------------------------------------------------------------', 0, 1, 'C');

        $this->fpdf->Cell(10,4,'Cant.', 0, 0, 'L');
        $this->fpdf->Cell(30,4,'Producto', 0, 0, 'L');
        $this->fpdf->Cell(20,4,'Precio x/u', 0, 0, 'L');
        $this->fpdf->Cell(20,4,'Total', 0, 0, 'L');
        $this->fpdf->Ln(4);
        $this->fpdf->Cell(70, 2, '-----------------------------------------------------------------------------------', 0, 1, 'C');

        $this->fpdf->SetFont('Arial', '', 7);
        $this->fpdf->MultiCell(70, 5, $pedido."                  $".$total."        ", 0, 'L');

        $this->fpdf->Output();
        exit;
    }

    public function show(){
        $pedidos = db::select('SELECT * FROM pedidos');
        return view("admin.pedidos", compact("pedidos"));
    }

    public function orderMoved($id){
        $moverPedido = DB::insert('INSERT INTO pedidos_entregados SELECT * FROM pedidos WHERE id = ?', [$id]);
        $pedidos = Pedidos::where("id",$id);
        $pedidos->delete();
        return back()->withSuccess('!Pedido entregado!');
    }

    public function ordersDelivered(){
        $pedidosEntregados = db::select("SELECT * FROM pedidos_entregados");
        return view("admin.pedidos-entregados", compact("pedidosEntregados"));
    }

    public function destroy($id){

        $pedidos = Pedidos::where("id",$id)->first();
        $pedidos->delete();

        return back()->withSuccess('!Pedido cancelado!');

    }
}

?>