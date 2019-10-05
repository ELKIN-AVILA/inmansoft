<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Modelequi;
use App\Marcaequi;

class ModelequiController extends Controller
{
    public function index(){
        $modelequi = DB::table('modelequi')->paginate(6);
        $marcaequi = Marcaequi::all();
        return view('Modelequi.index',['modelequi'=>$modelequi,'marcaequi'=>$marcaequi]);
    }
    public function guardar(Request $request){
        if($request->ajax()){
            $modelequi=new Modelequi();
            $modelequi->nombre=$request->nombre;
            $modelequi->marcaequi_id = $request->marcaequi;
            $modelequi->save();
            return response()->json('Se creo el registro exitosamente');
        }
    }
    public function editar(Request $request){
        if($request->ajax()){
            $modelequi=Modelequi::where('id','=',$request->id)->get();
            return response()->json($modelequi); 
        }
    }
    public function actualizar(Request $request){
        if($request->ajax()){
            $modelequi=Modelequi::where('id','=',$request->id)->update(['nombre'=> $request->nombre,'marcaequi_id'=>$request->marcaequi]);
            return response()->json("Se actualizo el registro exitosamente");
        }
    }
    public function eliminar(Request $request){
        if($request->ajax()){
            $modelequi=Modelequi::where('id','=',$request->id);
            $modelequi->delete();
            return response()->json("Se elimino correctament el registro");
        }
    }
}
