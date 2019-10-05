<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Tipequipo;

class TipequipoController extends Controller
{
    public function index(){
        $tipequipo=Tipequipo::all();
        return view('Tipequipo.index',['tipequipo'=>$tipequipo]);
    }
    public function guardar(Request $request){
        if($request->ajax()){
            $tipequipo=new Tipequipo();
            $tipequipo->nombre=$request->nombre;
            $tipequipo->save();
            return response()->json("se creo el tipo de equipo");
        }
    }
    public function editar(Request $request){
        if($request->ajax()){
            $tipequipo=Tipequipo::where('id','=',$request->id)->get();
            return response()->json($tipequipo);
        }
    }
    public function actualizar(Request $request){
        if($request->ajax()){
            $tipequipo=Tipequipo::where('id','=',$request->id)->update(['nombre'=>$request->nombre]);
            return response()->json("se actualizo el registro");
        }
    }
    public function eliminar(Request $request){
        if($request->ajax()){
            $tipequipo=Tipequipo::where('id','=',$request->id);
            $tipequipo->delete();
            return response()->json("se elimino el registro");
        }
    }   
}
