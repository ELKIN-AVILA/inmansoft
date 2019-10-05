<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Dependencias;
use App\Departamentos;
use App\Sede;
class DependenciasController extends Controller
{
    public function index(){
        $dependencias=Dependencias::all();
        $departamentos=Departamentos::all();
        $sede=Sede::all();
        return view('Dependencias.index',['sede'=>$sede,'dependencias'=>$dependencias,'departamentos'=>$departamentos]);
    }
    public function guardar(Request $request){
        if($request->ajax()){
            $dependencias=new Dependencias();
            $dependencias->nombre=$request->nombre;
            $dependencias->departamentos_id=$request->departamento;
            $dependencias->save();
            return response()->json("Se creo la depedencias");
        }

    }
    public function editar(Request $request){
        if($request->ajax()){
            $dependencias=Dependencias::where('id','=',$request->id)->get();
            return response($dependencias);
        }
    }
    public function actualizar(Request $request){
        if($request->ajax()){
            $dependencias=Dependencias::where('id','=',$request->id)->update(['nombre'=>$request->nombre,'departamentos_id'=>$request->departamentos]);
            return response()->json('Se actualizo la dependencia exitosamente');
        }
    }
    public function eliminar(Request $request){
        if($request->ajax()){
            $dependencias=Dependencias::where('id','=',$request->id);
            $dependencias->delete();
            return response()->json("Se elimino correctamente la dependencia");
        }
    }
    public function traedepar(Request $request){
        if($request->ajax()){
            $departamentos=Departamentos::where('sede_id','=',$request->id)->get();
            return response()->json($departamentos);
        }
    }
}
