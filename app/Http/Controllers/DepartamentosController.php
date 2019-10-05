<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departamentos;
use App\Sede;
use Illuminate\Support\Facades\DB;
class DepartamentosController extends Controller
{
    public function index(){
        $departamentos = Departamentos::all();
        $sedes=Sede::all();
        return view('Departamentos.index',['departamentos'=>$departamentos,'sedes'=>$sedes]);
    }
    public function guardar(Request $request){
        if($request->ajax()){
            $departamentos = new Departamentos();
            $departamentos->nombre=$request->nombre;
            $departamentos->sede_id=$request->sede;
            $departamentos->save();
            return response()->json("Se creo el departamento");
        }
    }
    public function editar(Request $request){
        if($request->ajax()){
            $departamentos = Departamentos::where('id','=',$request->id)->get();
            return response()->json($departamentos);
        }
    }
    public function actualizar(Request $request){
        if($request->ajax()){
            $departamentos=Departamentos::where('id','=',$request->id)->update(['nombre'=>$request->nombre,'sede_id'=>$request->sede]);
            return response()->json("Se actualizo el departamento");
        }
    }
    public function eliminar(Request $request){
        if($request->ajax()){
            $departamentos=Departamentos::where('id','=',$request->id);
            $departamentos->delete();
            return response()->json("Se elimino el departamento");
        }
    }
}
