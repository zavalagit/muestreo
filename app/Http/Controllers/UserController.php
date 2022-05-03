<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    public function get_users(Request $request){
		/*
			--El request debe tener:
				*folio o name (requerido)
				*tipo de user (opcional)
		*/
		$users = User::where(function($q) use($request){
								$q->where('folio','like',"%{$request->buscar}%")
									->orWhere('name','like',"%{$request->buscar}%");
								//user_tipo
								if ( $request->filled('user_tipo') ) {
									$q->where('tipo',$request->user_tipo);
								}
								//user_fiscalia
								if ( $request->filled('user_fiscalia') ) {
									$q->where('fiscalia_id',$request->user_fiscalia);
								}
								if ( $request->filled('user_unidad') ) {
									$q->where('unidad_id',$request->user_unidad);
								}
							})
							->take(5)
							->with('institucion')
							->with('cargo')
							->get();

		return response()->json([
			'registros' => $users,
		]);
	}
}
