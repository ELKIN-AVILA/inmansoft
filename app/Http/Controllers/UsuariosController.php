<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsuariosController extends Controller
{
    public function index(){
        $user=User::all();
        return view('Usuarios.index',['usuarios'=>$user]);
    }
    
    public function guardar(Request $request){
        if($request->ajax()){
            User::create([
                'name' => $request->nombre,
                'email' => $request->correo,
                'password' => bcrypt($request->contrasena),
            ]);
            return response()->json("Se creo el usuario");
        }
    }
    public function editar(Request $request){
        if($request->ajax()){
            $usuarios=User::where('id','=',$reques->id)->get();
            return response()->json($usuarios);
        }
    }
    public function actualizar(Request $request){
        if($request->ajax()){
            $usuarios=User::where('id','=',$reques->id)->update(['contrasena'=>$request->contrasena]);
            return response()->json("Se actualizo la contrasena del usuario");
        }
    }
}
