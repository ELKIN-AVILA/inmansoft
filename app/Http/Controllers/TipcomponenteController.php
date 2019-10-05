<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tipcomponente;

class TipcomponenteController extends Controller
{
    public function index(){
        $tipcomponente=Tipcomponente::all();
        return view('Tipcomponente.index',['tipcomponente'=>$tipcomponente]);
    }    
    public function guardar(Request $request){
        if($request->ajax()){
            $tipcomponente=new Tipcomponente();
            $tipcomponente->nombre=$request->nombre;
            $tipcomponente->save();
            return response()->json("Se creo el registro exitosamente");
        }
    }
    public function editar(Request $request){
        if($request->ajax()){
            $tipcomponente=Tipcomponente::where('id','=',$request->id)->get();
            return response()->json($tipcomponente);
        }
    }
    public function actualizar(Request $request){
        if($request->ajax()){
            $tipcomponente=Tipcomponente::where('id','=',$request->id)->update(['nombre'=>$request->nombre]);
            return response()->json("Se actualizo el registro exitosamente");
        }
    }
    public function eliminar(Request $request){
        if($request->ajax()){
            $tipcomponente=Tipcomponente::where('id','=',$request->id);
            $tipcomponente->delete();
            return response()->json("Se elimino el registro exitosamente");
        }
    }
}
