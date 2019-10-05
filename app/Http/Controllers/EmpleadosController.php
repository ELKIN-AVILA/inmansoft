<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Empleados;
use App\Cargo;

class EmpleadosController extends Controller
{
    public function index(){
	    $empleados=Empleados::all();
        $cargo=Cargo::all();
        return view('Empleados.index',['empleados'=>$empleados,'cargo'=>$cargo]);
    }
    public function guardar(Request $request){
        if($request->ajax()){
            $empleados=new Empleados();
            $empleados->priape=$request->priape;
            $empleados->segape=$request->segape;
            $empleados->prinom=$request->prinom;
            $empleados->segnom=$request->segnom;
            $empleados->correo=$request->correo;
            $empleados->celular=$request->celular;
            $empleados->cargo_id=$request->cargo;
            $empleados->save();
            return response()->json("Se creo el registro exitosamente");
        }
    }
    public function editar(Request $request){
        if($request->ajax()){
            $empleados=Empleados::where('id','=',$request->id)->get();
            return response()->json($empleados);
        }
    }
    public function actualizar(Request $request){
        if($request->ajax()){
            $empleados=Empleados::where('id','=',$request->id)->update(['priape'=>$request->priape,'segape'=>$request->segape,'prinom'=>$request->prinom,'segnom'=>$request->segnom,'correo'=>$request->correo,'celular'=>$request->celular,'cargo_id'=>$request->cargo]);
            return response()->json("Se actualizo el registro");
        }
    }
    public function eliminar(Request $request){
        if($request->ajax()){
            $empleados=Empleados::where('id','=',$request->id);
            $empleados->delete();
            return response()->json("Se elimino correctamente el registro");
        }
    }

}
