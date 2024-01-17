<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf;

class FpdfController extends Controller
{
    protected $fpdf;

    public function __construct()
    {
        $this->fpdf = new Fpdf('P','mm',array(80,150));
    }
    
    public function index(){
        $this->fpdf->AddPage();
        $this->fpdf->SetFont('Courier', 'B', 18);
        $this->fpdf->Cell(50, 25, 'Hello World!');
        $this->fpdf->Image('https://e7.pngegg.com/pngimages/894/41/png-clipart-club-atletico-river-plate-superliga-argentina-de-futbol-football-estadio-monumental-antonio-vespucio-liberti-river-plate-vs-estudiantes-de-la-plata-football-text-logo.png', 0, 30, 90, 0, 'PNG');
        $this->fpdf->Output();
        exit;
    }
}
