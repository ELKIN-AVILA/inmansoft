<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Tipmante;

class TipmanteController extends Controller
{
    public function index(){
        $tipmante=DB::table('tipmante')->paginate(6);
        return view('Tipmante.index',['tipmante'=>$tipmante]);
    }
    public function guardar(Request $request){
        if($request->ajax()){
            $tipmante=new Tipmante();
            $tipmante->nombre=$request->nombre;
            $tipmante->save();
            return response()->json("Se creo el registro exitosamente");
        }
    }
    public function editar(Request $request){
        if($request->ajax()){
            $tipmante=Tipmante::where('id','=',$request->id)->get();
            return response()->json($tipmante);
        }
    }
    public function actualizar(Request $request){
        if($request->ajax()){
            $tipmante=Tipmante::where('id','=',$request->id)->update(['nombre'=>$request->nombre]);
            return response()->json("se actualizo el registro correctamente");
        }
    }
    public function eliminar(Request $request){
        if($request->ajax()){
            $tipmante=Tipmante::where('id','=',$request->id);
            $tipmante->delete();
            return response()->json("se elimino el registro correctamente");
        }
    }   
}
