<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Rolxuser;
use App\User;

class RolxuserController extends Controller
{
    public function index(){
        $rolxuser=Rolxuser::all();
        $rol=Role::all();
        $usuarios=User::all();
        return view('Rolxuser.index',['rolxuser'=>$rolxuser,'rol'=>$rol,'usuarios'=>$usuarios]);
    }
    public function asignar(Request $request){
        $usuario=User::find($request->usuario_id);
        $usuario->assignRole($request->rol_id);
        return response()->json("Se Asigno el rol al usuario");
    }
}
