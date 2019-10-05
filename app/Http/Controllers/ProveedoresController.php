<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Proveedores;

class ProveedoresController extends Controller
{
    public function index(){
        $proveedores=DB::table('proveedores')->paginate(6);
        return view('Proveedores.index',['proveedores'=>$proveedores]);
    }
    public function guardar(Request $request){
        if($request->ajax()){
            $proveedores=new Proveedores();
            $proveedores->nit=$request->nit;
            $proveedores->razonsoc=$request->razonsoc;
            $proveedores->direccion=$request->direccion;
            $proveedores->correo=$request->correo;
            $proveedores->save();
            return response()->json("se creo el registro exitosamente");
        }
    }
    public function editar(Request $request){
        if($request->ajax()){
            $proveedores=Proveedores::where('id','=',$request->id)->get();
            return response()->json($proveedores);
        }
    }
    public function actualizar(Request $request){
        if($request->ajax()){
            $proveedores=Proveedores::where('id','=',$request->id)->update(['nit'=>$request->nit,'razonsoc'=>$request->razonsoc,'direccion'=>$request->direccion,'correo'=>$request->correo]);
            return response()->json("Se actualizo el registro existosamente");
        }
    }
    public function eliminar(Request $request){
        if($request->ajax()){
            $proveedores=Proveedores::where('id','=',$request->id);
            $proveedores->delete();
            return response()->json("Se elimino el registro exitosamente");
        }
    }
}
