<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Unidad;

class GetModeloController extends Controller
{
    public function get_modelo_unidad(Request $request){
        $unidades = Unidad::where('nombre','like','%'.$request->buscar.'%')->where('unidad_estado','activo')->orderBy('nombre', 'asc')->get();
        return response()->json(
            [
                'registros' => $unidades,
            ]
        );
    }
}
