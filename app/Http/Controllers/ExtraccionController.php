<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExtraccionController extends Controller
{
    public function create($formAccion){
        return view('extraccion.extraccion_create',compact('formAccion'));
    }
}
