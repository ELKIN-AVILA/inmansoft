<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;


class RolesController extends Controller
{
    public function index(){
        $roles=Role::all();
        return view('Roles.index',['roles'=>$roles]);
    }
    public function guardar(Request $request){
        $role = Role::create(['name' => $request->nombre]);
        return response()->json("Se creo el rol");
    }
}
