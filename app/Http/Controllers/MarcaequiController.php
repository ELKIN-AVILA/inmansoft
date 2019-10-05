<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Marcaequi;
class MarcaequiController extends Controller
{
    public function index(){
        $marcaequi=DB::table('marcaequi')->paginate(6);
        return view('Marcaequi.index',['marcaequi'=>$marcaequi]);
    }
    public function guardar(Request $request){
        if($request->ajax()){
            $marcaequi=new Marcaequi();
            $marcaequi->nombre=$request->nombre;
            $marcaequi->save();
            return response()->json("se creo la marca del equipo");
        }
    }
    public function editar(Request $request){
        if($request->ajax()){
            $marcaequi=Marcaequi::where('id','=',$request->id)->get();
            return response()->json($marcaequi);
        }
    }
    public function actualizar(Request $request){
        if($request->ajax()){
            $marcaequi=Marcaequi::where('id','=',$request->id)->update(['nombre'=>$request->nombre]);
            return response()->json("se actualizo el registro");
        }
    }
    public function eliminar(Request $request){
        if($request->ajax()){
            $marcaequi=Marcaequi::where('id','=',$request->id);
            $marcaequi->delete();
            return response()->json("se elimino el registro");
        }
    }
}
