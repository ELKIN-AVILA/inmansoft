<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Cargo;
class CargoController extends Controller
{
	public function index(){
		$cargo=DB::table('cargo')->paginate(6);
		return view('Cargo.index',['cargo'=>$cargo]);
	}
	public function guardar(Request $request){
		if($request->ajax()){
			$cargo=new Cargo();
			$cargo->nombre=$request->nombre;
			$cargo->save();
			return response()->json("se creo el cargo");
		}
	}
	public function editar(Request $request){
		if($request->ajax()){
			$cargo=Cargo::where('id','=',$request->id)->get();
			return response()->json($cargo);
		}
	}
	public function actualizar(Request $request){
		if($request->ajax()){
			$cargo=Cargo::where('id','=',$request->id)->update(['nombre'=>$request->nombre]);
			return response()->json("se actualizo el registro");
		}
	}
	public function eliminar(Request $request){
		if($request->ajax()){
			$cargo=Cargo::where('id','=',$request->id);
			$cargo->delete();
			return response()->json("se elimino el registro");
		}
	}
}
