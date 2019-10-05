<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Responsables;
use App\Empleados;
use App\Equipos;

class ResponsablesController extends Controller
{
    public function index(){
        $responsables=Responsables::all();
        $empleados=Empleados::all();
        $equipos=Equipos::all();
        return view('Responsables.index',['empleados'=>$empleados,'equipos'=>$equipos,'responsables'=>$responsables]);
    }
    public function guardar(Request $request){
        if($request->ajax()){
            $responsables=new Responsables();
            $responsables->empleados_id=$request->empleados_id;
            $responsables->equipos_id=$request->equipos_id;
            $responsables->save();
            return response()->json("Se creo el registro exitosamente");
        }
    }
    public function editar(Request $request){
        if($request->ajax()){
            $responsables=Responsables::where('id','=',$request->id)->get();
            return response()->json($responsables);
        }
    }
    public function actualizar(Request $request){
        if($request->ajax()){
            $responsables=Responsables::where('id','=',$request->id)->update(['empleados_id'=>$request->empleados_id,'equipos_id'=>$request->equipos_id]);
            return response()->json("Se actualizo el registro exitosamente");
        }
    }
    public function eliminar(Request $request){
        if($request->ajax()){
            $responsables=Responsables::where('id','=',$request->id);
            $responsables->delete();
            return response()->json("Se elimino el registro correctamente");
        }
    }
}
