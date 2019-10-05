<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Equipos;
use App\Tipequipo;
use App\Marcaequi;
use App\Modelequi;
use App\Proveedores;
use Barryvdh\DomPDF\Facade as PDF;

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
        $pdf = PDF::loadView('Pdf.equipos',['equipos'=>$equipos]);
        return $pdf->download('equipos.pdf');/**poner download / stream */
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
