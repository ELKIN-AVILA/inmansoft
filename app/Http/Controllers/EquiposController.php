<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Equipos;
use App\Tipequipo;
use App\Marcaequi;
use App\Modelequi;
use App\Proveedores;
use  Anouar\Fpdf\Facades\Fpdf as Fpdf;

class EquiposController extends Controller
{
    public function index(){
        $equipos=Equipos::all();
        $tipequipo=Tipequipo::all();
        $marcaequi=Marcaequi::all();
        $modelequi=Modelequi::all();
        $proveedores=Proveedores::all();
        return view('Equipos.index',['equipos'=>$equipos,'tipequipo'=>$tipequipo,'marcaequi'=>$marcaequi,'modelequi'=>$modelequi,'proveedores'=>$proveedores]);
    }    
    public function guardar(Request $request){
        if($request->ajax()){
            $estado;
            if($request->estado==1){
                $estado="A";
            }else{
                $estado="I";
    
            }
            $equipos=new Equipos();
            $equipos->numplaca=$request->numplaca;
            $equipos->estado=$estado;
            $equipos->tipequipo_id=$request->tipequipo;
            $equipos->marcaequi_id=$request->marcaequipo;
            $equipos->modelequi_id=$request->modelequipo;
            $equipos->serial=$request->serial;
            $equipos->fechacompra=$request->fechacompra;
            $equipos->valcompra= floatval($request->valcompra);
            $equipos->fechaegre=$request->fechaegreso;
            $equipos->proveedores_id=$request->proveedor;  
            $equipos->save();
            return response()->json("Se creo el registro exitosamente");
        }
    }
    public function editar(Request $request){
        if($request->ajax()){
            $equipos=Equipos::where('id','=',$request->id)->get();
            return response()->json($equipos);
        }
    }
    public function actualizar(Request $request){
        if($request->ajax()){
           
            $equipos=Equipos::where('id','=',$request->id)->update(['numplaca'=>$request->numplaca,'tipequipo_id'=>$request->tipequipo,'marcaequi_id'=>$request->marcaequipo,'modelequi_id'=>$request->modelequipo,'serial'=>$request->serial,'fechacompra'=>$request->fechacompra,'valcompra'=>$request->valcompra,'fechaegre'=>$request->fechaegre,'proveedores_id'=>$request->proveedores]);
            return response()->json('Se actualizo el registro exitosamente');
        }
    }
    public function pdf(){
        $equipos=Equipos::all();
        $fpdf = new Fpdf();
		$fpdf::AddPage('L','Legal');
		$fpdf::SetFont('Arial','B',16);
		$fpdf::SetTitle("Formato de Mantenimiento Equipo-",true);
		$fpdf::Image('img/camara.png',40,13,32);
		$fpdf::SetXY(10,10);
		$fpdf::Cell(340,32,"",1,0,'C');
		$fpdf::SetFont('Arial','',12);
		$fpdf::SetXY(310,10);
        $fpdf::Cell(40,8.3,"SI-FRT-000",1,1,'C');
        $fpdf::Cell(340,8,"Inventario de Equipos Electronicos",0,1,'C');
        $fpdf::Ln();
        $fpdf::Ln();
        $fpdf::Cell(34,8,"Numero Placa",1,0,'C');
        $fpdf::Cell(26,8,"Estado",1,0,'C');
        $fpdf::Cell(42,8,"Tipo Equipo",1,0,'C');
        $fpdf::Cell(34,8,"Marca Equipo",1,0,'C');
        $fpdf::Cell(34,8,"Modelo Equipo",1,0,'C');
        $fpdf::Cell(34,8,"Serial",1,0,'C');
        $fpdf::Cell(34,8,"Fecha Compra",1,0,'C');
        $fpdf::Cell(34,8,"Valor Compra",1,0,'C');
        $fpdf::Cell(34,8,"Fecha Egreso",1,0,'C');
        $fpdf::Cell(34,8,"Proveedor",1,1,'C');
        $fpdf::SetFont('Arial','',9);
        foreach($equipos as $mequi){
            $fpdf::Cell(34,8,$mequi->numplaca,1,0,'C');
            $fpdf::Cell(26,8,$mequi->estado,1,0,'C');
            $tipequipo=Tipequipo::all();
            foreach($tipequipo as $mtip){
                if($mtip->id==$mequi->tipequipo_id){
                    $fpdf::Cell(42,8,$mtip->nombre,1,0,'C');
                }
            }
            $marcaequi=Marcaequi::all();
            foreach($marcaequi as $mmarca){
                if($mequi->marcaequi_id==$mmarca->id){
                    $fpdf::Cell(34,8,$mmarca->nombre,1,0,'C');
                }
            }
            $modelequi=Modelequi::all();
            foreach($modelequi as $mmodele){
                if($mmodele->id == $mequi->modelequi_id){
                    $fpdf::Cell(34,8,$mmodele->nombre,1,0,'C');
                }
            }
            $fpdf::Cell(34,8,$mequi->serial,1,0,'C');
            $fpdf::Cell(34,8,$mequi->fechacompra,1,0,'C');
            $fpdf::Cell(34,8,number_format($mequi->valcompra,2,'.',''),1,0,'C');
            $fpdf::Cell(34,8,$mequi->fechaegre,1,0,'C');
            $proveedores=Proveedores::all();
            foreach($proveedores as $mpro){
                if($mpro->id==$mequi->proveedores_id){
                    $fpdf::Cell(34,8,$mpro->razonsoc,1,1,'C');
                }
            }
        }

		/**poner D */
		$fpdf::Output('');
		exit;
    }
    public function informacion(Request $request){
        if($request->ajax()){
            $equipos=Equipos::where('id','=',$request->id)->get();
            $tipequipo;
            $marcaequipo;
            $modelequi;
            $proveedores;
            foreach($equipos as $mequi){
                $tipequipo=Tipequipo::where('id','=',$mequi->tipequipo_id)->get();
                $marcaequipo=Marcaequi::where('id','=',$mequi->marcaequi_id)->get();
                $modelequi=Modelequi::where('id','=',$mequi->modelequi_id)->get();
                $proveedores=Proveedores::where('id','=',$mequi->proveedores_id)->get();
            }
            return response()->json(['equipos'=>$equipos,'tipequipo'=>$tipequipo,'marcaequipo'=>$marcaequipo,'modelequipo'=>$modelequi,'proveedores'=>$proveedores]);
        }
    }
    public function traemodelo(Request $request){
    	if($request->ajax()){
		$modelequi=Modelequi::where('marcaequi_id','=',$request->id)->get();
		return response()->json($modelequi);	
	}
    }
}
