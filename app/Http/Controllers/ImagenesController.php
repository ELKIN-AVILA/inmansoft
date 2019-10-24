<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImagenesController extends Controller
{
    public function index(){
        return view('Imagenes.index');
    }
    public function uploadImages()
    {
    	$imgName = request()->file->getClientOriginalName();
        request()->file->move(public_path('images'), $imgName);
    	return response()->json(['uploaded' => '/images/'.$imgName]);
    }
}
