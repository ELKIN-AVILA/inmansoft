<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Componentes;
use App\Tipcomponente;
class ComponentesController extends Controller
{
    public function index(){
        $componentes=Componentes::all();
        $tipcomponentes=Tipcomponente::all();
        return view('Componentes.index',['componentes'=>$componentes,'tipcomponentes'=>$tipcomponentes]);
    }
    public function guardar(Request $request){
        if($request->ajax()){
            $componentes=new Componentes();
            $componentes->nombre=$request->nombre;
            $componentes->tipcomponentes_id=$request->tipcomponentes;
            $componentes->save();
            return response()->json("Se creo el registro exitosamente");
        }
    }
    public function editar(Request $request){
        if($request->ajax()){
            $componentes=Componentes::where('id','=',$request->id)->get();
            return response()->json($componentes);
        }
    }
    public function actualizar(Request $request){
        if($request->ajax()){
            $componentes=Componentes::where('id','=',$request->id)->update(['nombre'=>$request->nombre,'tipcomponentes_id'=>$request->tipcomponentes]);
            return response()->json("Se actualizo el registro exitosamente");
        }
    }
    public function eliminar(Request $request){
        if($request->ajax()){
            $componentes=Componentes::where('id','=',$request->id);
            $componentes->delete();
            return response()->json("Se elimino el registro exitosamente");
        }
    }

}
