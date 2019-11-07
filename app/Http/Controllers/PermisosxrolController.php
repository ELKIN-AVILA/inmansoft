<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Permixrol;

class PermisosxrolController extends Controller
{
    public function index(){
        $permixrol=Permixrol::all();
        $rol=Role::all();
        $permisos=Permission::all();
        return view('Permisosxrol.index',['permixrol'=>$permixrol,'rol'=>$rol,'permisos'=>$permisos]);
    }
    public function asignar(Request $request){
        $rol=Role::find($request->rol_id);
        $rol->givePermissionTo($request->permiso_id);
        return response()->json("Se asigno el permiso al rol");
    }
}
