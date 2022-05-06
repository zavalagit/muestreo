<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Cim;
use App\Expediente;
use App\Indicio;
use App\Proceso;
use Illuminate\Support\Facades\Auth;

class ExpedienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('expediente.index',[
            'expedientes' => Expediente::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('expediente.create');
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
        DB::transaction(function () use ($request) {
            $expediente = Expediente::create($request->all());
            $proceso = Proceso::create($request->all());
            $proceso->expediente_id = $expediente->id;
            $proceso->save();
            //separando los indicios en grupos de acuerdo a la cadena que pertenecen
            $indicios = Indicio::find($request->indicios);
            foreach ($indicios as $i => $indicio) {
                if( !isset($indicio->cim) ) $this->set_cim($indicio);
                $proceso->indicios()->attach($indicio);
            }
        }, 3);

        return 'todo bien';

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

    protected function set_cim($indicio)
    {
        DB::transaction(function() use($indicio) {
            $cim = Cim::firstOrCreate( ['year' => date('Y'),'consecutivo' => 0] );
            $cim->consecutivo += 1;
            $cim->indicio_id = $indicio->id;
            $cim->user_id = Auth::id();
            $cim->save();
            $indicio->cim = $cim->consecutivo.'/'.$cim->year;
            $indicio->save();
        }, 3);
    }
}
