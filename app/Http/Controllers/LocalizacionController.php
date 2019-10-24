<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Localizacion;
use App\Departamentos;
use App\Dependencias;
use App\Equipos;
use App\Sede;

class LocalizacionController extends Controller
{
    public function index(){
        $localizacion=Localizacion::all();
        $departamentos=Departamentos::all();
        $dependencias=Dependencias::all();
        $equipos=Equipos::all();
        $equi=DB::table('equipos')->leftJoin('localizacion','equipos.id','=','localizacion.equipos_id')->select('equipos.id','equipos.numplaca')->whereNull('localizacion.id')->get();
        $sede=Sede::all();
        return view('Localizacion.index',['equi'=>$equi,'localizacion'=>$localizacion,'departamentos'=>$departamentos,'dependencias'=>$dependencias,'equipos'=>$equipos,'sedes'=>$sede]);
    }
    public function guardar(Request $request){
        if($request->ajax()){
            $localizacion=new Localizacion();
            $localizacion->sede_id=$request->sede;
            $localizacion->departamentos_id=$request->departamento;
            $localizacion->dependencias_id=$request->dependencias;
            $localizacion->equipos_id=$request->equipos;
            $localizacion->save();
            return response()->json("Se creo el registro exitosamente");
        }
    }
    public function editar(Request $request){
        if($request->ajax()){
            $localizacion=Localizacion::where('id','=',$request->id)->get();
            return response()->json($localizacion);
        }
    }
    public function actualizar(Request $request){
        if($request->ajax()){
            $localizacion=Localizacion::where('id','=',$request->id)->update(['sede_id'=>$request->sede,'departamentos_id'=>$request->departamento,'dependencias_id'=>$request->dependencias,'equipos_id'=>$request->equipos]);
            return response()->json("Se actualizo correctamente el registro");
        }
    }
    public function eliminar(Request $request){
        if($request->ajax()){
            $localizacion=Localizacion::where('id','=',$request->id);
            $localizacion->delete();
            return response()->json("Se elimino el registro exitosamente");
        }
    }
    public function traerdependencias(Request $request){
        if($request->ajax()){
            $dependencias=Dependencias::where('departamentos_id','=',$request->id)->get();
            return response()->json($dependencias);
        }
    }
}
