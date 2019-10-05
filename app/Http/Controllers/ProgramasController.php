<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Programas;
use App\Versionpro;

class ProgramasController extends Controller
{
    public function index(){
        $programas=Programas::all();
        return view('Programas.index',['programas'=>$programas]);
    }
    public function guardar(Request $request){
        if($request->ajax()){
            $programas=new Programas();
            $programas->nombre=$request->nombre;
            $programas->save();
            return response()->json("Se creo el registro exitosamente");
        }
    }
    public function editar(Request $request){
        if($request->ajax()){
            $programas=Programas::where('id','=',$request->id)->get();
            return response()->json($programas);
        }
    }
    public function actualizar(Request $request){
        if($request->ajax()){
            $programas=Programas::where('id','=',$request->id)->update(['nombre'=>$request->nombre]);
            return response()->json("Se actualizo el registro");
        }
    }
    public function eliminar(Request $request){
        if($request->ajax()){
            $programas=Programas::where('id','=',$request->id);
            $programas->delete();
            return response()->json("Se elimino el registro exitosamente");
        }
    }
    public function agregar(Request $request){
        if($request->ajax()){
            $programa=Programas::find($request->id);
            $nombre=$programa->nombre;
            $versionpro=Versionpro::where('programas_id','=',$request->id)->get();
            return response()->json(['version'=>$versionpro,'id'=>$request->id,'nombre'=>$nombre]);  
        }
    }
    public function guardarvers(Request $request){
        if($request->ajax()){
            $verspro=new Versionpro();
            $verspro->programas_id=$request->id;
            $verspro->nombre=$request->numver;
            $verspro->save();
            return response()->json("Se creo la version");
        }
    }
    public function eliminarvers(Request $request){
        if($request->ajax()){
            $version=Versionpro::where('id','=',$request->id);
            $version->delete();
            return response()->json("Se elimino correctamente la version");            
        }
    }
}
