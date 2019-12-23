<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  Anouar\Fpdf\Facades\Fpdf as Fpdf;
use Illuminate\Support\Facades\DB;
use App\Sede;
use App\Departamentos;
use App\Dependencias;
use App\Equipos;
use App\Empleados;
use App\Cargo;
use App\Responsables;
use App\Proveedores;

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
            return response()->json($fpdf);        
    }
    public function reportesedes(Request $request){
            $fpdf = new Fpdf();
            $fpdf::AddPage('L','Legal');
            $fpdf::SetFont('Arial','B',16);
            $fpdf::SetTitle("REPORTE DE SEDES",true);
            $fpdf::Image('img/camara.png',40,10,32);
            $fpdf::SetXY(10,10);
            $fpdf::Cell(340,25,"",1,0,'C');
            $fpdf::SetFont('Arial','',12);
            $fpdf::SetXY(310,10);
            $fpdf::Cell(40,8.3,"SI-FRT-000",1,1,'C');
            $fpdf::SetXY(310,18.3);
            $fpdf::Cell(40,8.3,"VERSION 1",1,1,'C');
            $fpdf::SetXY(310,26.6);
            $fpdf::Cell(40,8.3,"Pagina 1 de 1",1,1,'C');
            $fpdf::SetXY(35,10);
            $fpdf::SetFont('Arial','B',16);    
            $fpdf::Cell(315,20,'REPORTE DE SEDES',0,1,'C');
            $fpdf::SetXY(10,35);
            $fpdf::SetFillColor(180,240,255);
            $fpdf::SetFont('Arial','',14);    
            $fpdf::Cell(170,8,"NOMBRE",1,0,'C',1);
            $fpdf::Cell(170,8,"CANTIDAD DE EQUIPOS",1,1,'C',1);
            $sede=Sede::all();
            foreach($sede as $msede){
                $localizacion=DB::table('localizacion')->where('sede_id','=',$msede->id)->count();
                $fpdf::SetFont('Arial','',14);    
                $fpdf::Cell(170,8,$msede->nombre,1,0,'C');
                $fpdf::Cell(170,8,$localizacion,1,1,'C');
            }
            $fpdf::Output('D');
            exit;        
         
    }
    public function reporteempleados(Request $request){
            $empleados=Empleados::all();
            $cargos=Cargo::all();
            $fpdf = new Fpdf();
            $fpdf::AddPage('L','Legal');
            $fpdf::SetFont('Arial','B',16);
            $fpdf::SetTitle("REPORTE DE EMPLEADOS",true);
            $fpdf::Image('img/camara.png',40,10,32);
            $fpdf::SetXY(10,10);
            $fpdf::Cell(340,25,"",1,0,'C');
            $fpdf::SetFont('Arial','',12);
            $fpdf::SetXY(310,10);
            $fpdf::Cell(40,8.3,"SI-FRT-000",1,1,'C');
            $fpdf::SetXY(310,18.3);
            $fpdf::Cell(40,8.3,"VERSION 1",1,1,'C');
            $fpdf::SetXY(310,26.6);
            $fpdf::Cell(40,8.3,"Pagina 1 de 1",1,1,'C');
            $fpdf::SetXY(35,10);
            $fpdf::SetFont('Arial','B',16);    
            $fpdf::Cell(315,20,'REPORTE DE EMPLEADOS',0,1,'C');
            $fpdf::SetXY(10,35);
            $fpdf::SetFillColor(134,130,126);
            $fpdf::SetFont('Arial','',13);
            $fpdf::Cell(56.66,8,"PRIMER NOMBRE",1,0,'C',1);
            $fpdf::Cell(56.66,8,"SEGUNDO NOMBRE",1,0,'C',1);
            $fpdf::Cell(46.66,8,"PRIMER APELLIDO",1,0,'C',1);
            $fpdf::Cell(46.66,8,"SEGUNDO APELLIDO",1,0,'C',1);
            $fpdf::Cell(26.66,8,"CELULAR",1,0,'C',1);
            $fpdf::Cell(106.66,8,"CARGO",1,1,'C',1);
            $fpdf::SetFont('Arial','',12);
            foreach($empleados as $memple){
                $fpdf::Cell(56.66,8,$memple->prinom,1,0,'C');
                $fpdf::Cell(56.66,8,$memple->segnom,1,0,'C');
                $fpdf::Cell(46.66,8,utf8_decode($memple->priape),1,0,'C');
                $fpdf::Cell(46.66,8,utf8_decode($memple->segape),1,0,'C');
                $fpdf::Cell(26.66,8,$memple->celular,1,0,'C');
                foreach($cargos as $mcargo){
                    if($mcargo->id==$memple->cargo_id){
                        $fpdf::Cell(106.66,8,$mcargo->nombre,1,1,'C'); 
                    }
                }
            }
            $fpdf::Output('D');
            exit;   
   
    }
    public function reporteresponsablesequipos(Request $request){
            $responsables=Responsables::all();
            $empleados=Empleados::all();
            $equipos=Equipos::all();
            $fpdf = new Fpdf();
            $fpdf::AddPage('L','Legal');
            $fpdf::SetFont('Arial','B',16);
            $fpdf::SetTitle("REPORTE DE RESPONSABLE DE EQUIPOS",true);
            $fpdf::Image('img/camara.png',40,10,32);
            $fpdf::SetXY(10,10);
            $fpdf::Cell(340,25,"",1,0,'C');
            $fpdf::SetFont('Arial','',12);
            $fpdf::SetXY(310,10);
            $fpdf::Cell(40,8.3,"SI-FRT-000",1,1,'C');
            $fpdf::SetXY(310,18.3);
            $fpdf::Cell(40,8.3,"VERSION 1",1,1,'C');
            $fpdf::SetXY(310,26.6);
            $fpdf::Cell(40,8.3,"Pagina 1 de 1",1,1,'C');
            $fpdf::SetXY(35,10);
            $fpdf::SetFont('Arial','B',16);    
            $fpdf::Cell(315,20,'REPORTE DE RESPONSABLE DE EQUIPOS',0,1,'C');
            $fpdf::SetXY(10,35);
            $fpdf::SetFillColor(134,130,126);
            $fpdf::SetFont('Arial','',13);
            $fpdf::Cell(170,8,"NOMBRE",1,0,'C',1);
            $fpdf::Cell(170,8,"NUMERO DE PLACA",1,1,'C',1);
            $fpdf::SetFont('Arial','',12);
            foreach($responsables as $mresp){
                foreach($empleados as $memple){
                    if($mresp->empleados_id==$memple->id){
                        $fpdf::Cell(170,8,utf8_decode($memple->priape.' '.$memple->segape.' '.$memple->prinom.' '.$memple->segnom),1,0,'C');
                    }
                }
                foreach($equipos as $mequipo){
                    if($mresp->equipos_id==$mequipo->id){
                        $fpdf::Cell(170,8,$mequipo->numplaca,1,1,'C');
                    }
                }
            }
            $fpdf::Output('I');
            exit;   
        
    }
    public function reporteproveedores(Request $request){
        $proveedores=Proveedores::all();
        $fpdf = new Fpdf();
        $fpdf::AddPage('L','Legal');
        $fpdf::SetFont('Arial','B',16);
        $fpdf::SetTitle("REPORTE DE PROVEEDORES",true);
        $fpdf::Image('img/camara.png',40,10,32);
        $fpdf::SetXY(10,10);
        $fpdf::Cell(340,25,"",1,0,'C');
        $fpdf::SetFont('Arial','',12);
        $fpdf::SetXY(310,10);
        $fpdf::Cell(40,8.3,"SI-FRT-000",1,1,'C');
        $fpdf::SetXY(310,18.3);
        $fpdf::Cell(40,8.3,"VERSION 1",1,1,'C');
        $fpdf::SetXY(310,26.6);
        $fpdf::Cell(40,8.3,"Pagina 1 de 1",1,1,'C');
        $fpdf::SetXY(35,10);
        $fpdf::SetFont('Arial','B',16);    
        $fpdf::Cell(315,20,'REPORTE DE PROVEEDORES',0,1,'C');
        $fpdf::SetXY(10,35);
        $fpdf::SetFillColor(134,130,126);
        $fpdf::SetFont('Arial','',13);
        $fpdf::Cell(30,8,"NIT",1,0,'C',1);
        $fpdf::Cell(170,8,"RAZON SOCIAL",1,0,'C',1);
        $fpdf::Cell(100,8,"CORREO",1,0,'C',1);
        $fpdf::Cell(40,8,"CELULAR",1,1,'C',1);
        $fpdf::SetFont('Arial','',10);
        foreach($proveedores as $mpro){
            $fpdf::Cell(30,8,$mpro->nit,1,0,'C');
            $fpdf::Cell(170,8,$mpro->razonsoc,1,0,'C');
            $fpdf::Cell(100,8,$mpro->correo,1,0,'C');
            $fpdf::Cell(40,8,"",1,1,'C');
        }
        $fpdf::Output('I');
        exit;   
    
    }
    public function reportelocalizacion(Request $request){
            $sedes=Sede::all();
            $departamentos=Departamentos::all();
            $dependencias=Dependencias::all();
            $equipos=Equipos::all();
            $fpdf = new Fpdf();
            $fpdf::AddPage('L','Legal');
            $fpdf::SetFont('Arial','B',16);
            $fpdf::SetTitle("REPORTE DE SEDES",true);
            $fpdf::Image('img/camara.png',40,10,32);
            $fpdf::SetXY(10,10);
            $fpdf::Cell(340,25,"",1,0,'C');
            $fpdf::SetFont('Arial','',12);
            $fpdf::SetXY(310,10);
            $fpdf::Cell(40,8.3,"SI-FRT-000",1,1,'C');
            $fpdf::SetXY(310,18.3);
            $fpdf::Cell(40,8.3,"VERSION 1",1,1,'C');
            $fpdf::SetXY(310,26.6);
            $fpdf::Cell(40,8.3,"Pagina 1 de 1",1,1,'C');
            $fpdf::SetXY(35,10);
            $fpdf::SetFont('Arial','B',16);    
            $fpdf::Cell(315,20,'REPORTE DE SEDES',0,1,'C');
            $fpdf::SetXY(10,35);
            $fpdf::SetFillColor(180,240,255);
            $fpdf::SetFont('Arial','',14);    
            $fpdf::Cell(170,8,"NOMBRE",1,0,'C',1);
            $fpdf::Cell(170,8,"CANTIDAD DE EQUIPOS",1,1,'C',1);
            $sede=Sede::all();
            foreach($sede as $msede){
                $localizacion=DB::table('localizacion')->where('sede_id','=',$msede->id)->count();
                $fpdf::SetFont('Arial','',14);    
                $fpdf::Cell(170,8,$msede->nombre,1,0,'C');
                $fpdf::Cell(170,8,$localizacion,1,1,'C');
            }
            $fpdf::Output('D');
            exit;   
    }
}
