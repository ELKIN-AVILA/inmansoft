<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  Anouar\Fpdf\Facades\Fpdf as Fpdf;
use App\Sede;

class ReportesController extends Controller
{
    public function index(){
        $sede=Sede::all();
        return view('Reportes.index',['sedes'=>$sede]);
    }
    public function reporteequipos(Request $request){
            
            $fpdf = new Fpdf();
            $fpdf::AddPage('L','Legal');
            $fpdf::SetFont('Arial','B',16);
            $fpdf::SetTitle("CRONOGRAMA MANTENIMIENTO DE EQUIPOS",true);
            $fpdf::Image('img/camara.png',40,10,32);
            $fpdf::SetXY(10,10);
            $fpdf::Cell(340,30,"",1,0,'C');
            $fpdf::SetFont('Arial','',12);
            $fpdf::Output('D');
            exit;        
    }
}
