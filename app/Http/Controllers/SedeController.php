<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sede;

class SedeController extends Controller
{
    public function index(){
        $sedes=Sede::all();
        return view('Sede.index',['sedes'=>$sedes]);
    } 
    public function guardar(Request $request){
        if($request->ajax()){
            $sede=new Sede();
            $sede->nombre=$request->nombre;
            $sede->estado=$request->estado;
            $sede->save();
            return response()->json("Se creo el registro exitosamente");
        }
    }
    public function editar(Request $request){
        if($request->ajax()){
            $sede=Sede::where('id','=',$request->id)->get();
            return response()->json($sede);
        }
    }
    public function actualizar(Request $request){
        if($request->ajax()){
            $sede=Sede::where('id','=',$request->id)->update(['nombre'=>$request->nombre,'estado'=>$request->estado]);
            return response()->json("Se actualizo el registro exitosamente");
        }
    }
    public function eliminar(Request $request){
        if($request->ajax()){
            $sede=Sede::where('id','=',$request->id);
            $sede->delete();
            return response()->json("Se elimino el registro exitosamente");
        }
    }   
}
