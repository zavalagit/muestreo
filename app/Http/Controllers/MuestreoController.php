<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Muestreo;

class MuestreoController extends Controller
{
    public function create($formAccion){
        return view('etapa.muestreo.muestreo_create',compact('formAccion'));
    }
    public function store(Request $request){
        // return $request->all();
        // return ['fecha' => $request->input('fecha')];
        $muestreo = Muestreo::create($request->all());
        $muestreo->user1_id = Auth::id();
        $muestreo->save();
        return $muestreo;
    }
}
