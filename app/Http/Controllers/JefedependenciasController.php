<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Departamentos;
use App\Jefedependencia;
use App\Sede;
use App\Empleados;
use App\Dependencias;

class JefedependenciasController extends Controller
{
    public function index(){
        $jefe=Jefedependencia::all();
        $sede=Sede::all();
        $empleados=Empleados::all();
        $dependencias=Dependencias::all();
        $departamentos=Departamentos::all();
        $emplea=DB::table('empleados')->join('jefedependencias','jefedependencias.empleados_id','!=','empleados.id')->select('empleados.*')->get();
        return view('Jefedependencias.index',['jefedepar'=>$jefe,'sede'=>$sede,'empleados'=>$empleados,'departamentos'=>$departamentos,'dependencias'=>$dependencias,'emple'=>$emplea]);
    }
    public function guardar(Request $request){
        if($request->ajax()){
            $jefedepart=new Jefedependencia(); 
            $jefedepart->sede_id=$request->sede_id;
            $jefedepart->departamentos_id=$request->departamentos_id;
            $jefedepart->dependencias_id=$request->dependencias;
            $jefedepart->empleados_id=$request->empleados_id;
            $jefedepart->save();
            return response()->json("Se creo el registro exitosamente");
        }
    }
    public function editar(Request $request){
        if($request->ajax()){
            $jefedepart=Jefedependencia::where('id','=',$request->id)->get();
            return response()->json($jefedepart);
        }
    }
    public function actualizar(Request $request){
        if($request->ajax()){
            $jefedepart=Jefedependencia::where('id','=',$request->id)->update(['sede_id'=>$request->sede_id,'departamentos_id'=>$request->departamentos_id,'dependencias_id'=>$request->dependencias,'empleados_id'=>$request->empleados_id]);
            return response()->json("Se actualizo el registro correctamente");
        }
    }
    public function eliminar(Request $request){
        if($request->ajax()){
            $jefedepart=Jefedependencia::where('id','=',$request->id);
            $jefedepart->delete();
            return response()->json("Se elimino el registro correctamente");
        }
    }
    public function depart(Request $request){
        if($request->ajax()){
            $departamentos=Departamentos::where('sede_id','=',$request->id)->get();
            return response()->json($departamentos);
        }
    }
    
    public function dependencias(Request $request){
        if($request->ajax()){
            $dependencias=Dependencias::where('departamentos_id','=',$request->id)->get();
            return response()->json($dependencias);
        }
    }
    
}
