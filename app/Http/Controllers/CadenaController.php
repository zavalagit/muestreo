<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use PDF;
use App\Cadena;
use App\Indicio;
use App\Institucion;
use App\Municipio;
use App\Unidad;

class CadenaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->flash();
    //   if ($request->filled('buscar')) {
    //      $cadenas = Cadena::buscar($request->buscar)->get();
    //      return view('cadena.index', [
    //         'cadenas' => $cadenas,
    //         'buscar' => $request->buscar,
    //      ]);
    //   } else {
    //      $cadenas = Cadena::where('user_id', Auth::id())->orderBy('id', 'desc')->latest()->take(20)->get();
    //      return view('cadena.index', [
    //         'cadenas' => $cadenas,
    //      ]);
    //   }

        $cadenas = Cadena::where('user_id', Auth::id())->orderBy('id', 'desc')->latest()->take(20)->get();
        return view('cadena.index', [
            'cadenas' => $cadenas,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cadena.create',[
            'unidades' => Unidad::all(),
            'Instituciones' => Institucion::all(),
            'municipios' => Municipio::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();

        $cadena = Cadena::create($request->all());
        $cadena->user_id = Auth::id();
        $cadena->save();
        // guardar en tabla intermedia cadena_user
        for ($i = 0; $i < count($request->sp_id); $i++) {
            $cadena->users()->attach($request->sp_id[$i], ['etapa' => $request->sp_etapa[$i]]);
        }
        //guardar en tabla indicios
        foreach ($request->identificador as $i => $identificador) {
            $indicio = Indicio::create([
                'identificador'         => $request->identificador[$i],
                'cantidad'              => $request->cantidad[$i],
                'cantidad_disponoble'   => $request->cantidad[$i],
                'descripcion'            => $request->descripcion[$i],
                'embalaje'              => $request->embalaje[$i],
                'observaciones'         => $request->observaciones[$i],
            ]);            
            $indicio->cadena_id = $cadena->id;
            $indicio->save();
        }

        return $cadena;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function cadena_pdf(Request $request, Cadena $cadena)
    {
      set_time_limit(0);
      //QrCode::generate('Transfórmame en un QrCode!', public_path('codigoQr/codigoqr.png'));
      // QrCode::format('png');
      // QrCode::size(100);
      // QrCode::color(0,0,0);
      // QrCode::errorCorrection('M');
      // QrCode::generate("http://201.116.252.147/codigoQR/{$cadena->id}", '../public/codigoQr/codigoqr.png');


      $pdf = PDF::loadView('cadena.cadena_anexo3', compact('cadena'));
      if ($request->hoja_tipo === 'oficio')
         $pdf->setPaper('A4', 'portrait');
      return $pdf->stream();
    }

    #etiqueta
    public function etiqueta_form(Request $request, Cadena $cadena){
    	return view('cadena.etiqueta.form',['cadena' => $cadena]);
    	// return view('modal.formulario_para_modal_etiqueta',['cadena' => $cadena]);
    }
    public function etiqueta_pdf(Request $request, Cadena $cadena){
        // return $request->all();
        $request->flash();
        $pdf = PDF::loadView('cadena.etiqueta.pdf', compact('cadena'));
        if ($request->hoja_tipo === 'oficio') $pdf->setPaper('A4', 'portrait');
        return $pdf->stream();
    }
    
}
