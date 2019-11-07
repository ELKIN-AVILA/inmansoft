<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission; 
class PermisosController extends Controller
{
    public function index(){
        $permisos=Permission::all();
        return view('Permisos.index',['permisos'=>$permisos]);
    }
    public function guardar(Request $request){
        $permisos=Permission::create(['name' => $request->nombre]);
        return response()->json("Se creo el permiso");
    }
}
