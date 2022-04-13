<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\PeticionController;
use App\Peticion;
use App\Ubicacion;
use Illuminate\Support\Facades\Auth;



Route::get('/',function(){
   return redirect('/login');
})->middleware('checkSesion');

   Route::get('cerrar-sesion',function(){
      Auth::logout();
      return redirect('/');
   })->name('cerrar-sesion');

   Route::get('codigoQR/{id}','QrController@codigo_qr');
   Route::get('codigoQR-prestamo/{id}','QrController@codigo_qr_prestamo');

   Route::post('autocompletar','AutocompleteController@autocompletar');
   Route::post('datos-perito','AutocompleteController@perito');


//Busqueda
   Route::post('naturaleza-select',function(){
      $naturalezas = App\Naturaleza::all();
      return response()->json([
         'naturalezas' => $naturalezas,
      ]);
   });


#cadena
Route::get('cadena-form/{formAccion}/{cadena?}','CadenaController@cadena_form')->name('cadena_form');
Route::post('cadena-save/{formAccion}/{cadena?}','CadenaController@cadena_save')->name('cadena_save')->middleware('auth');


Route::get('muestreos/create/{formAccion}','MuestreoController@create')->name('muestreos.create');
Route::post('muestreos','MuestreoController@store')->name('muestreos.store');


//Get_Tablas
   Route::post('get-especialidades','GetTablasController@get_especialidades');
   // Route::post('get-unidades','GetTablasController@get_unidades');

//Perito
   //Registro cadena (Formulario)
      // Route::get('registrar-cadena','CadenaController@cadena_form')->middleware('auth')->middleware('perito');
   //Registro cadena (Guardar)
      Route::post('cadena-guardar/{id?}','CadenaController@cadena_guardar')->middleware('auth')->middleware('perito');
   //Consultar cadena
      Route::get('consultar-cadena','CadenaPeritoController@consultar')->name('cadena_consultar')->middleware('auth')->middleware('perito');
   //Mis datos
      Route::get('mis-datos','PeritoController@mis_datos');
      Route::post('cambiar-password','PeritoController@cambiar_password');
   //Editar cadena
      //Formulario para editar
      Route::get('editar-cadena/{id}','CadenaController@editar_form')->middleware('auth','perito','editar');
      //Actulizando datos
      //Route::post('actualizar-cadena-perito/{id}','CadenaPeritoController@actualizar');


      Route::get('elegir',function(){
         return view('sesion_perito.elegir');
      });


   //Clonar cadena
  //    Route::post('cadena-clonar','ClonarController@cadena_clonar');

   //PDFs(Anexos y etiqueta)
      //Anexo 3
      Route::get('anexo-3/{id_cadena}','PDF\AnexosController@anexo3');
      //Anexo 4
      Route::get('anexo-4/{id_cadena}','PDF\AnexosController@anexo4');
      //Etiqueta
      Route::get('etiqueta/{tipo}/{id}','PDFController@etiquetapdf');
      Route::get('etiqueta-pdf/{id_cadena}','EtiquetaContrxoller@etiqueta_pdf');

      //Etiqueta por indicio
      Route::get('etiqueta_id/{id}','PDFController@etiqueta_id_pdf');

      //ETIQUETA NUEVA
      Route::post('etiqueta-get-indicios/{id_cadena}','EtiquetaController@etiqueta_get_indicios');
      Route::post('etiqueta-crear','EtiquetaController@etiqueta_crear');
      Route::get('etiqueta','EtiquetaController@etiqueta_personalizada');


      //CLONAR CADENA
      Route::get('clonar-cadena/{id}','CadenaController@clonar_form')->middleware('auth','perito');
//      Route::post('clonar-guardar','ClonarController@clonar_cadena');

//Administrador
   Route::prefix('administrador')->group(function(){
      Route::get('inicio',function(){
         return view('administrador.inicio');
      });


      


      //Cadenas
      //Route::get('cadenas','CadenasController@cadenas');
      
      #Usuarios
         Route::get('usuarios','UsuarioController@usuarios');
         Route::get('usuario-editar/{id}','UsuarioController@usuario_editar');
         Route::post('usuario-editar-guardar','UsuarioController@usuario_editar_guardar');
         Route::get('user-password/{id_user}','UserController@user_password');
         Route::post('user-password-guardar/{id_user}','UserController@user_password_guardar');
      //Resguardantes
      Route::get('resguardantes','ResguardanteController@resguardantes');
      //Fiscalias

      Route::get('fiscalia','FiscaliaController@vista');

      Route::post('fiscalia-datos','FiscaliaController@datos');

      Route::get('fiscalia/{fiscalia?}/revisar','EntradaController@cadena_a_validar');
      Route::get('fiscalia/{fiscalia?}/entradas/{buscar?}','EntradaController@entradas');
      //Instituciones
      Route::get('instituciones','InstitucionController@instituciones');
      //Naturalezas
      Route::get('naturalezas','NaturalezaController@naturalezas');
      #Unidad
      Route::get('unidades','UnidadController@unidades');
      Route::get('unidad-formulario/{id_unidad?}','UnidadController@unidad_formulario');
      Route::post('unidad-guardar/{id_unidad?}','UnidadController@unidad_guardar');
      #Cargo
      Route::get('cargos','CargoController@cargos');
      Route::get('cargo-formulario/{id_cargo?}','CargoController@cargo_formulario');
      Route::post('cargo-guardar/{id_cargo?}','CargoController@cargo_guardar');
      #Fiscalia
      Route::get('fiscalias','FiscaliaController@fiscalias');
      Route::get('fiscalia-formulario/{id_fiscalia?}','FiscaliaController@fiscalia_formulario');
      Route::post('fiscalia-guardar/{id_fiscalia?}','FiscaliaController@fiscalia_guardar');
      #Naturaleza
      Route::get('naturalezas','NaturalezaController@naturalezas');
      Route::get('naturaleza-formulario/{id_naturaleza?}','NaturalezaController@naturaleza_formulario');
      Route::post('naturaleza-guardar/{id_naturaleza?}','NaturalezaController@naturaleza_guardar');
      #Institucion
      Route::get('instituciones','InstitucionController@instituciones');
      Route::get('institucion-formulario/{id_institucion?}','InstitucionController@institucion_formulario');
      Route::post('institucion-guardar/{id_institucion?}','InstitucionController@institucion_guardar');
      //Administración de cadenas
      // Route::get('editar-cadena/{id}','AdministrarCadenaController@editar_cadena');


      #Servidores publicos
         Route::get('resguardantes','ResguardanteController@resguardantes');
         Route::get('resguardante-editar/{id_resguardante}','ResguardanteController@resguardante_editar');
         Route::post('resguardante-guardar/{id_resguardante}','ResguardanteController@resguardante_guardar');
   });

//Bodega
   Route::prefix('bodega')->group(function(){
      //Cadenas sin visto bueno (cadenas por aprobar)
         Route::get('revisar','EntradaController@cadena_a_validar')->name('revisar');
      //Formulario de la Cadena que se le acaba de ar el visto bueno
         Route::get('alta/{idCadena}','EntradaController@form_validar');

         Route::post('autocompletar','EntradaController@autocompletar');
         Route::post('perito-entrega','EntradaController@perito_entrega');

         
          
         //Route::post('save_alta','CedulaController@save_alta')->middleware('verificaAlta');
         Route::post('save_alta','EntradaController@save_alta');
      //Cadenas(cedulas) que estan aprobadas por lo tanto a tienen folio
         Route::get('entradas','EntradaController@entradas')->name('entradas');
         Route::post('entrada-acciones/{cadena}','EntradaController@entrada_acciones');

      #Prestamo
         //form pretamo y reingreso; formAccion => ['prestar','reingresar',editar]
         Route::get('prestamo-form/{formAccion}/{cadena}/{prestamo?}','PrestamoController@prestamo_form')->name('prestamo_form');
         //vista que se agrega a la tabla solo si la cantidad de indicios al reingresar es diferente a cuando se presta
         Route::post('load-view-reingreso-descripcion-disponible-tr/{indicio}','LoadViewController@load_view_reingreso_descripcion_disponible_tr')->name('reingreso_descripcion_disponible_view');
         // form para prestamo multiple; formAccion => 'prestar'
         Route::get('prestamo-multiple-form/{formAccion}/{cadenas}','PrestamoController@prestamo_multiple_form')->name('prestamo_multiple_form');
         //save tanto para prestamo, prestamo_multiple, reingreso, reingreso_multiple, editar; formAccion => ['prestar','reingresar',editar] , prestamo => no es requerido en multiple
         Route::post('prestamo-save/{formAccion}/{prestamo?}','PrestamoController@prestamo_save')->name('prestamo_save');
         //pdf para prestamo y reingreso
         Route::get('prestamo-pdf/{prestamo}','PDFController@prestamo');
         //pdf para prestamo_multiple
         Route::get('prestamo-multiple-pdf/{array_prestamos}','PrestamoController@prestamo_multiple_pdf');
         //consultar
         Route::get('prestamo-consultar','PrestamoController@prestamo_consultar')->name('prestamo_consultar');
         //eliminar prestamo
         Route::post('prestamo-eliminar/{prestamo}','PrestamoController@prestamo_eliminar')->name('prestamo_eliminar');
         Route::get('reingreso-multiple-form/{formAccion}/{prestamos}','PrestamoController@reingreso_multiple_form')->name('reingreso_multiple_form');
         
         // Route::post('prestamo-create','PrestamoController@prestamo_create'); //?
         // Route::get('prestamos','PrestamoController@prestamo_consultar');
         // Route::get('prestamos','PrestamoController@prestamos');
         // Route::get('reingreso/{id_prestamo}','PrestamoController@reingreso_form');
         // Route::post('reingreso-save','PrestamoController@reingreso_save');
         // Route::post('reingreso-multiple-save','PrestamoController@reingreso_multiple_save');
         // Route::get('prestamo-editar-form/{id_prestamo}','PrestamoController@prestamo_editar_form');
         // RouTe::post('prestamo-editar-save','PrestamoController@prestamo_editar_save');
         

      #Baja
         Route::get('baja-form/{formAccion}/{cadena}/{baja?}','BajaController@baja_form')->name('baja_form');//bien
         Route::post('load-view-baja-parcial-tr/{indicio}','LoadViewController@load_view_baja_parcial_tr')->name('baja_parcial_vista');//bien
         Route::post('baja-save/{formAaccion}/{cadena}/{baja?}','BajaController@baja_save');
         Route::get('baja-pdf/{baja}','PDFController@baja_pdf')->name('baja_pdf');
         Route::post('baja-eliminar/{baja}','BajaController@baja_eliminar')->name('baja_eliminar');
         Route::get('baja-consultar','BajaController@baja_consultar')->name('baja_consultar');

         //HISTORIAL
         Route::get('historial-cadena/{cadena}','HistorialController@historial');


      //Resguardantes
         Route::get('registrar-resguardante','ResguardanteController@registrar_resguardante');
         Route::post('guardar-resguardante','ResguardanteController@guardar_resguardante');
         Route::post('prestamo-resguardante','ResguardanteController@prestamo_resguardante');
         Route::post('resguardante-datos','ResguardanteController@resguardante_datos');


         //Resguardo
         Route::get('administrar-bodega','ResguardoController@form_bodega');

         Route::post('store-lugar','ResguardoController@store_lugar');
         Route::post('store-charola','ResguardoController@store_charola');
         Route::post('store-caja','ResguardoController@store_caja');
         Route::post('store-ubicacion','ResguardoController@ubicacion');
         Route::post('resguardar-todo','ResguardoController@resguardar_todo');

         Route::post('store-bodega','ResguardoController@simon');
         Route::get('resguardo/{id_cadena}','ResguardoController@vista');

         Route::post('pruebas','CedulaController@pruebas');



         //NOTA
         Route::post('nota-guardar','NotaController@nota_guardar');
         Route::post('nota-obtener','NotaController@nota_obtener');
         //Validar
         Route::post('validar-guardar','ControlCadenaController@validar_guardar');
         //cadenas rechazadas
         Route::get('cadenas-rechazadas','ControlCadenaController@cadenas_rechazadas');
         //Cadenas validadas en espera a que lleguen a bodega
         Route::get('cadenas-validadas','ControlCadenaController@cadenas_validadas');
         //Asignar Folio-Bodega y poner en espera
         // Route::post('asignar-folio','ControlCadenaController@asignar_folio');
         //Cadenas en espera (ya tienen un folio) a que lleguen los indicios
         Route::get('cadenas-espera','ControlCadenaController@cadenas_espera');


         //Cadena Foranea
         Route::get('capturar','CadenaForaneaController@form');
         Route::post('guardar-foranea','CadenaForaneaController@guardar');


         //Agregar cadena para emparejar
         Route::get('cadena-agregar',function(){
            return view('bodega.cadena_agregar');
         });
         Route::post('cadena-guardar','CadenaController@cadena_guardar');




         Route::get('capturar-perito','PeritoController@perito_registrar');
         Route::post('perito-guardar','PeritoController@perito_guardar');


         //Reporte
         Route::get('reporte','EntradaController@reporte');
         Route::get('reporte-diario','PDFController@reporte_diario');

         //Caratula
         Route::get('caratula',function(){
            return view('bodega.caratula');
         });
         Route::get('caratula-pdf','PDFController@caratula');


         //Escoger RB
         Route::post('rb-buscar','RBController@rb_buscar');
         Route::post('rb-datos','RBController@rb_datos');



         //Editar
         Route::get('editar/{cadena}','EditarController@editar_vista');
         Route::post('editar-guardar','EditarController@editar_guardar');

/*
         //Estadistica
         Route::get('estadistica','PDFController@estadisticas');
         Route::post('estadistica-entradas','PDFController@estadistica_entradas');
         Route::post('estadistica-reporte','PDFController@estadistica_totales');
         Route::post('estadistica-baja','PDFController@estadistica_baja');
*/
         //Busqueda nuc
         Route::get('buscarnuc', 'PDFController@Busqueda');


         //Estadistica
         Route::get('estadistica','EstadisticaController@estadistica_mensual');
         Route::get('estadistica-entradas','EstadisticaController@estadistica_entradas');
         Route::post('estadistica-reporte','EstadisticaController@estadistica_totales');
         Route::post('estadistica-baja','EstadisticaController@estadistica_baja');

         //Lista de Cadenas
         Route::get('lista-cadenas',function(){
            $fiscalias = App\Fiscalia::all();
            $naturalezas = App\Naturaleza::all();
            return view('bodega.lista_cadenas',compact('fiscalias','naturalezas'));
         });
         Route::get('lista-cadenas-pdf','PDFController@lista_cadenas_pdf');
         //Lista de Cadenas General
         Route::get('lista-cadenas-general',function(){
            $fiscalias = App\Fiscalia::all();
            $naturalezas = App\Naturaleza::all();
            return view('bodega.lista_cadenas_general',compact('fiscalias','naturalezas'));
         });
         Route::get('lista-cadenas-archivo','PDFController@lista_general');

         #listado - copias - cadenas
         Route::get('listado-copias-cadenas',function(){
            $fiscalias = App\Fiscalia::all();
            $naturalezas = App\Naturaleza::all();
            return view('bodega.listado_copias_cadenas',compact('fiscalias','naturalezas'));
         });
         Route::get('listado-oficio','ListadoController@listado_oficio');
         Route::post('listado-oficio-historial','ListadoController@listado_oficio_historial');


         //INVENTARIO
         Route::get('inventario','InventarioController@inventario');

   });

//Autenticacion



Route::get('registro-anexos',function(){
   return view('registro-anexos');
});


//Route::get('editar-cadena-perito/{id}','CadtempController@editar');

Route::resource('registro-cadena','CadenaController');


Route::post('store-cad-temp','CadtempController@store');

//Route::get("anexos-pdf","ReporteController@pdf");

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('peticion-consultar-nuevo','Peticiones\PeritoController@peticion_consultar_nuevo'); //eliminar-ruta

   #Foto
   Route::get('foto-form/{modelo}/{modelo_id}','FotoController@foto_form')->name('foto_form');
   Route::post('foto-save/{modelo}/{modelo_id}','FotoController@foto_save')->name('foto_save');
   Route::post('load-foto-form/{modelo}/{modelo_id}','LoadViewController@load_foto_form');

   
   #Peticion
   Route::get('peticion-form/{formAccion}/{peticion?}','Peticion2Controller@peticion_form')->name('peticion_form');
   Route::post('peticion-save/{formAccion}/{peticion?}','Peticion2Controller@peticion_save')->name('peticion_save');
   Route::get('peticion-consultar','Peticion2Controller@peticion_consultar')->name('peticion_consultar');
   Route::post('peticion-informacion/{peticion}','Peticion2Controller@peticion_informacion');
   Route::post('peticion-eliminar/{peticion}','Peticion2Controller@peticion_eliminar')->name('peticion_eliminar');
   Route::get('peticion2-estadistica','Peticion2Controller@peticion_estadistica')->name('peticion_estadistica');
   Route::get('peticion2-dia','Peticion2Controller@peticion_dia')->name('peticion_dia');
   Route::post('vista-return-select-regiones','Peticion2Controller@vista_return_select_regiones');
   Route::get('peticion-reporte/{modelo}/{modelo_id}','Peticion2Controller@peticion_reporte')->name('peticion_reporte');
   Route::get('peticion-reporte-pdf/{modelo}/{modelo_id}','Peticion2Controller@peticion_reporte_pdf')->name('peticion_reporte_pdf');
   Route::get('peticion-consultar-necropsias','Peticion2Controller@peticion_consultar_necropsias')->name('peticion_consultar_necropsias');

   #ReturnVista
   //Especialidad
   Route::post('get-especialidades-options/{unidad}','ReturnViewController@get_especialidades_options');
   //Solicitud
   Route::post('get-solicitudes-options/{especialidad}','ReturnViewController@get_solicitudes_options');
   //Necropsia
   Route::post('get-necropsias-options/{necropsia_clasificacion}','ReturnViewController@get_necropsias_options');
   //Unidad
   Route::post('get-unidades-options/{unidad}','ReturnViewController@get_unidades_options');

   #Colectivo
   Route::get('colectivo-form/{accion}/{colectivo?}','ColectivoController@colectivo_form')->name('colectivo_form')->middleware('colectivoForm');
   Route::post('colectivo-form-parentesco/{accion}','ParentescoController@colectivo_form_parentesco');
   Route::post('colectivo-save/{accion}/{colectivo?}','ColectivoController@colectivo_save');
   Route::get('colectivo-consultar/{colectivo_estado?}','ColectivoController@colectivo_consultar')->name('colectivo_consultar');
   Route::post('colectivo-eliminar/{colectivo}','ColectivoController@colectivo_eliminar')->name('colectivo_eliminar')->middleware('colectivoEliminar');
   Route::post('colectivo-parentesco-modal/{colectivo}','ColectivoController@colectivo_parentesco_modal');
   Route::post('colectivo-form-parentesco-otro/{accion}','ParentescoController@colectivo_form_parentesco_otro');
   Route::get('colectivo-match/{colectivo}','ColectivoController@colectivo_match')->name('colectivo_match');
   Route::post('colectivo-modal-grupo-familiar/{colectivo}','ColectivoController@colectivo_modal_grupo_familiar');
   Route::post('colectivo-grupo-familiar-save','ColectivoController@colectivo_grupo_familiar_save')->name('colectivo_grupo_familiar_save');
   Route::get('colectivo-etapa/{colectivo}','ColectivoController@colectivo_etapa')->name('colectivo_etapa');
   Route::post('colectivo-form-objeto-donado/{accion}','ColectivoController@colectivo_form_objeto_aportado');
   Route::post('colectivo-form-municipio-procedencia/{entidad}','ColectivoController@colectivo_form_municipio_procedencia');
   Route::get('colectivo-estadistica/{modelo}/{modelo_id?}','ColectivoController@colectivo_estadistica')->name('colectivo_estadistica');

   
/**__PETICIONES
 * ___Director
 */


//Route::get('peticion-estadistica-director','Peticiones\DirectorController@peticion_estadistica');

Route::get('estadistica/{lugar}/{lugar_id}','Peticiones\CoordinadorController@estadistica');
//Route::get('peticion-diaria-coordinador','Peticiones\CoordinadorController@peticion_diaria');
Route::get('concentrado','Peticiones\CoordinadorController@concentrado');


Route::get('peticion-dia/{lugar}/{lugar_id?}','PeticionController@peticion_dia');
Route::get('peticion-buscar','PeticionController@peticion_buscar');
Route::get('peticion-estadistica/{lugar?}/{lugar_id?}','PeticionController@peticion_estadistica');
Route::get('peticion-estadistica-elegir/{unidad?}','PeticionController@peticion_estadistica_elegir');
Route::get('peticion-reporte','PeticionPDFController@peticion_solicitud_vista');
// Route::get('peticion-consultar','PeticionController@peticion_consultar');
      

   //sideNav
      Route::get('sidenav',function(){
         return view('pruebas.sidenav');
      });
      Route::get('boton',function(){
         return view('pruebas.boton');
      });


      Route::get('pruebas','PruebasController@peritos');


      Route::get('informe','PruebasController@informe');
      Route::get('balistico','PruebasController@balistico');


      Route::get('acuse','PruebasController@acuse');

      Route::get('cadena','PruebasController@cadena');

      Route::get('andres','PruebasController@andres');
      Route::get('geolocalizacion','PruebasController@geolocalizacion');


//Dictamen
	


Route::get('rea',function(){
   $peticiones = Peticion::where('solicitud_id',61)->where('fecha_elaboracion','<','2020-06-01')->whereBetween('fecha_sistema',['2020-06-01','2020-06-30'])->where('fiscalia2_id',4)->where('unidad_id',2)->get();

   //dd($peticiones->count());

   foreach ($peticiones as $key => $peticion) {
      $peticion->fecha_elaboracion = $peticion->fecha_sistema;
      $peticion->solicitud_id = 58;
      $peticion->necropsia_id = null;
      $peticion->save();
   }
});
      


      


        //petadscripciones
        






Route::get('estadistica-ie','Estadistica\EstadisticaController@estadistica_ie');
Route::get('estadistica-anio','Estadistica\EstadisticaController@estadistica_anio');



Route::get('peticion-unidad',function(){
   set_time_limit(0);
   $peticiones = App\Peticion::all();

   foreach ($peticiones as $key => $peticion) {
      $peticion->unidad_id = $peticion->user->unidad->id;
      $peticion->save();
   }

});
Route::get('fiscalia2',function(){
   set_time_limit(0);
   $peticiones = App\Peticion::all();

   foreach ($peticiones as $key => $peticion) {
      $peticion->fiscalia2_id = $peticion->user->fiscalia->id;
      $peticion->save();
   }

});


Route::get('/clear-cache', function() {
   Artisan::call('cache:clear');
   return "Cache is cleared";
});


Route::get('listado-anio','PDFController@listado_anio');





Route::get('lista-ano',function(){
   set_time_limit(0);

   return Excel::download(new App\Exports\CadenasExport, 'listado_cadenas_2020-06-08.xlsx');

});


Route::get('reporte-armas',function(){
   return view('reportes.reporte_armas');
});
Route::get('reporte-armas-pdf','PDFController@reporte_armas');




Route::get('listado-general',function(){
   return Excel::download(new App\Exports\ListadoExport, 'listado_rpbi.xlsx');
});






//Ubicacion
Route::get('ubicacion-administrar','UbicacionController@ubicacion_administrar');
Route::post('ubicacion-agregar/{id?}','UbicacionController@ubicacion_agregar');
Route::get('ubicacion-editar/{id}','UbicacionController@ubicacion_editar');
Route::get('ubicacion-consultar','UbicacionController@ubicacion_consultar');
Route::get('ubicacion-asignar/{id}','UbicacionController@ubicacion_asignar');
Route::post('ubicacion-get','UbicacionController@ubicacion_get');
Route::post('ubicacion-general-guardar','UbicacionController@ubicacion_general_guardar');
Route::post('ubicacion-indicio-guardar','UbicacionController@ubicacion_indicio_guardar');













Route::get('cadena-editar',function(){
   set_time_limit(0);
   $cadenas = App\Cadena::all();

   foreach ($cadenas as $key => $cadena) {
      if ($cadena->estado === 'revision') {
         $cadena->editar = 'si';
      }
      elseif ($cadena->estado != 'revision') {
         $cadena->editar = 'no';
      }

      $cadena->save();
   }
});



Route::get('inventario-general','InventarioController@inventario_general');
Route::get('inventario-general-actualizar','InventarioController@inventario_general_actualizar');

Route::get('loading',function(){
   return view('pruebas.loading');
});



Route::post('cadena-editar-habilitar/{cadena}','AdministrarCadenaController@cadena_editar_habilitar');


Route::get('usuario-cadenas/{id_user}','AdministrarCadenaController@cadenas');





Route::get('fiscal-inicio','FiscalController@fiscal_inicio')->middleware('auth','checkFiscal');
Route::get('fiscal-vista','FiscalController@fiscal_vista')->middleware('auth','checkFiscal');
Route::get('reporte-solicitudes-fiscal/{id_fiscalia}/{fecha}','FiscalController@reporte_solicitudes')->middleware('auth','checkFiscal');









Route::post('get-necropsias','Peticiones\PeritoController@get_necropsias');





Route::get('contador','PruebasController@contador');




Route::get('fiscalia-cambiar/{cadena_id}','CadenaController@fiscalia_cambiar');
Route::post('fiscalia-cambiar-guardar','CadenaController@fiscalia_cambiar_guardar');


Route::get('resguardo-temporal-cadena-buscar','ResguardoTemporalController@resguardo_temporal_cadena_buscar');


Route::get('cantidad-estudios',function(){
   set_time_limit(0);

   $peticiones = App\Peticion::whereIn('estado',['atendida','entregada'])->get();

   foreach ($peticiones as $key => $peticion) {
      $peticion->cantidad_estudios = 1;
      $peticion->save();
   }


});


Route::get('fecha-recepcion',function(){

   set_time_limit(0);
   
   $peticiones = Peticion::all();

   foreach ($peticiones as $key => $peticion) {
      $peticion->fecha_recepcion = $peticion->fecha_peticion;
      $peticion->save();
   }



});



Route::post('users-lista','AutocompleteController@users_lista');
Route::post('peritos-lista','AutocompleteController@peritos_lista');






Route::get('fecha-sistema',function(){

   set_time_limit(0);
   
   $peticiones = App\Peticion::whereIn('estado',['atendida','entregada'])->get();

   foreach ($peticiones as $key => $peticion) {
      if(($peticion->estado == 'atendida') && ($peticion->fecha_elaboracion ==  strftime('%Y-%m-%d', strtotime($peticion->created_at))) ){
            $peticion->fecha_sistema = $peticion->fecha_elaboracion;

      }elseif(($peticion->estado == 'atendida') && ($peticion->fecha_elaboracion <= strftime('%Y-%m-%d', strtotime($peticion->created_at))) ){
         $peticion->fecha_sistema = strftime('%Y-%m-%d', strtotime($peticion->created_at));

      }elseif(($peticion->estado == 'atendida') && ($peticion->fecha_elaboracion > strftime('%Y-%m-%d', strtotime($peticion->created_at)))){
         $peticion->fecha_sistema = strftime('%Y-%m-%d', strtotime($peticion->update_at));

      }elseif(($peticion->estado == 'entregada') && ($peticion->fecha_elaboracion >  strftime('%Y-%m-%d', strtotime($peticion->created_at)))){
         $peticion->fecha_sistema = $peticion->fecha_elaboracion;

      }elseif(($peticion->estado == 'entregada') && ($peticion->fecha_elaboracion <  strftime('%Y-%m-%d', strtotime($peticion->created_at)))){
         $peticion->fecha_sistema = strftime('%Y-%m-%d', strtotime($peticion->created_at));

      }elseif(($peticion->estado == 'entregada') && ($peticion->fecha_elaboracion == strftime('%Y-%m-%d', strtotime($peticion->update_at)))){
         $peticion->fecha_sistema = $peticion->fecha_elaboracion;

      }elseif(($peticion->estado == 'entregada') && ($peticion->fecha_elaboracion == strftime('%Y-%m-%d', strtotime($peticion->created_at)))){
         $peticion->fecha_sistema = $peticion->fecha_elaboracion;
         
      }else{

            dd($peticion->id);

      }
      
      $peticion->save();
   }



});


Route::get('fecha-local',function(){


   setlocale(LC_TIME,"es_MX.UTF-8");
        date_default_timezone_set('America/Mexico_City');
        $fecha_hoy = date("Y-m-d");
        $hora_actual = localtime();


        dd("{$fecha_hoy} {$hora_actual}");


});



/*
Route::get('peticiones-reasignar',function(){
   set_time_limit(0);
   $peticiones = App\Peticion::where('created_at','like',"%2020-05%")->where('fecha_recepcion','like',"%2019%")->where('fiscalia2_id',5)->get();

   //dd($peticiones->count());

   foreach ($peticiones as $key => $peticion) {
      $espacio = strpos($peticion->created_at,' ');
      $hora = substr($peticion->created_at,$espacio + 1);
      $peticion->created_at = "{$peticion->fecha_recepcion} {$hora}";

      $peticion->fecha_sistema = $peticion->fecha_elaboracion;

      $peticion->save();
      
   }
});
*/

Route::get('peticiones-reasignar',function(){

   set_time_limit(0);
   
   //Apatzingan
   $peticiones = App\Peticion::where('created_at','like',"%2020-05%")
                              ->where('fiscalia2_id',1)
                              ->where('fecha_recepcion','like',"%2020-04%")
                              //->whereBetween('fecha_recepcion',["%2020-04-01%","2020-04-21%"])
                              ->where('documento_emitido','informe')
                              //->where('solicitud_id',61)
                              ->where('unidad_id',1)
                              ->where('fecha_elaboracion','not like',"%2020-05%")
                              ->get();


   
   dd($peticiones->count());

   /*
   //Uruapan
   $peticiones = App\Peticion::where('created_at','like',"%2020-05%")
                              ->where('fiscalia2_id',5)
                              ->where('fecha_recepcion','like',"%2020-03%")
                              //->whereBetween('fecha_recepcion',["%2020-04-01%","2020-04-21%"])
                              ->where('documento_emitido','informe')
                              ->where('fecha_elaboracion','not like',"%2020-05%")
                              ->get();
*/

   //dd($peticiones->count(  ));

   foreach ($peticiones as $key => $peticion) {
      $espacio = strpos($peticion->created_at,' ');
      $hora = substr($peticion->created_at,$espacio + 1);
      $peticion->created_at = "{$peticion->fecha_recepcion} {$hora}";
      $peticion->fecha_sistema = $peticion->fecha_elaboracion;
      $peticion->save();
   }
});



Route::get('entrada-clonar',function(){

   $folios = array('20-16014','20-16620','20-16621','20-16622','20-16623','20-16624');
   $n = 1;
   foreach ($folios as $key => $folio) {
      $cadena = App\Cadena::where('folio_bodega',$folio)->get();
      $cadena = $cadena[0];

      $cadena_clon = $cadena->replicate();
      $cadena_clon->null;
      $cadena_clon->fiscalia_id = 4;
      $cadena_clon->estado = 'revision';
      $cadena_clon->save();
      
      /*
      $entrada_clon = $cadena->entrada->replicate();
      $entrada_clon->user_id = 7;
      $entrada_clon->cadena_id = $cadena_clon->id;
      $entrada_clon->save();
*/

      foreach ($cadena->indicios as $key => $indicio) {
         $indicio_clon = $indicio->replicate();
         $indicio_clon->estado = 'activo';
         $indicio_clon->baja_id = NULL;
         $indicio_clon->cadena_id = $cadena_clon->id;
         $indicio_clon->save();
      }
      
   }

});






Route::get('reacomodo',function(){
   set_time_limit(0);

   $peticiones = App\Peticion::all();
   $solicitudes = App\Solicitud::all();


   foreach ($peticiones as $key => $peticion) {
      $peticion->unidad_id = $peticion->solicitud->especialidad->unidad_id;
      $peticion->save();
   }
});


Route::get('ids',function(){
   $peticion = App\Peticion::find(110000);

   dd($peticion->solicitud->especialidad->solicitudes->pluck('id'));
});






Route::get('concentrado-dia/{lugar}/{lugar_id}','PeticionController@concentrado_dia');
Route::get('peticion-necropsias/{lugar}/{lugar_id}','PeticionController@peticion_necropsias');



Route::get('fecha-necropsia',function(){
   set_time_limit(0);
   $peticiones = App\Peticion::whereIn('estado',['atendida','entregada'])->get();
   //dd($peticiones->count());


   foreach ($peticiones as $key => $peticion) {
      //echo "{$peticion->id} <br>";
      //dd('holas');


      if( ($peticion->solicitud_id == 61) || ($peticion->solicitud_id == 62) ){
         $peticion->fecha_necropsia = $peticion->fecha_elaboracion;
      }
      else{
         $peticion->fecha_necropsia = null;
      }

      $peticion->save();
   }
   
});



Route::get('josa',function(){

   $reingresos = App\Prestamo::where('reingreso_fecha','2019-12-19')
                              ->whereHas('cadena',function($q){
                                 $q->where('fiscalia_id',4);
                              })
                              ->get();

   $n = 1;
   foreach ($reingresos as $key => $reingreso) {
      echo "{$n}.- {$reingreso->cadena->folio_bodega} - {$reingreso->cadena->nuc} - {$reingreso->cadena->entrada->fecha} <br>";
      $n++;
   }

});




Route::get('cantidad-indicios',function(){

   // $indicios = App\Indicio::whereHas('cadena',function($q){
   //    //$q->where('fiscalia_id',4)
   //       $q->whereHas('entrada',function($a){
   //          $a->where('naturaleza_id',17);
   //       });
   // })
   // ->where('estado','activo')
   // //->where('descripcion','like','%pulmón%')
   // ->get();

   // dd('pulmón: '.$indicios->sum('numero_indicios'));


   $indicios = App\Indicio::whereHas('cadena',function($q){
      $q->where('fiscalia_id',7)
         ->whereHas('entrada',function($a){
            $a->where('tipo','indicio')
               ->whereBetween('fecha',['2020-06-01','2020-06-30']);
         });
   })
   //->where('estado','activo')
   //->where('descripcion','like','%pulmón%')
   ->get();

   echo "indicios: {$indicios->sum('numero_indicios')} <br>";
   
   $indicios = App\Indicio::whereHas('cadena',function($q){
      $q->where('fiscalia_id',7)
         ->whereHas('entrada',function($a){
            $a->where('tipo','evidencia')
               ->whereBetween('fecha',['2020-06-01','2020-06-30']);
         });
   })
   //->where('estado','activo')
   //->where('descripcion','like','%pulmón%')
   ->get();

   echo "evidencias: {$indicios->sum('numero_indicios')} <br>";
   
   #Prestamos
   $indicios = App\Indicio::whereHas('cadena',function($q){
                              $q->where('fiscalia_id',7);
                           })
                           ->whereHas('prestamos',function($q){
                              $q->whereBetween('prestamo_fecha',['2020-06-01','2020-06-30']);
                           })
   //->where('estado','activo')
   //->where('descripcion','like','%pulmón%')
   ->get();

   echo "prestamos: {$indicios->sum('numero_indicios')} <br>";
   
   #bajas
   $indicios = App\Indicio::whereHas('cadena',function($q){
                              $q->where('fiscalia_id',7);
                           })
                           ->whereHas('baja',function($q){
                              $q->whereBetween('fecha',['2020-06-01','2020-06-30']);
                           })
   //->where('estado','activo')
   //->where('descripcion','like','%pulmón%')
   ->get();

   echo "bajas: {$indicios->sum('numero_indicios')} <br>";




});


Route::get('acomodar-necros',function(){
  

   $peticiones = App\Peticion::where('fiscalia2_id',5)
                              ->whereBetween('fecha_sistema',['2020-01-01','2020-01-31'])
                              ->where('solicitud_id',61)
                              ->whereNull('necropsia_id')
                              ->get();

   // foreach ($peticiones as $key => $peticion) {
   //    $peticion->fecha_sistema = $peticion->fecha_elaboracion;
   //    $peticion->necropsia_id=1;
   //    $peticion->save();
   // }

   dd($peticiones->count());
});









Route::get('peticion-fiscalia',function(){

// use App\Exports\ExcelViewExport;
// use Maatwebsite\Excel\Facades\Excel;
   
   $peticiones = App\Peticion::whereBetween('fecha_recepcion',['2020-06-01','2020-06-30'])->where('fiscalia2_id',4)->get();
   $unidades = App\Unidad::where('coordinacion','si')->get();
   $petfiscalias = App\Petfiscalia::where('fiscalia_id',4)->get();

   return Maatwebsite\Excel\Facades\Excel::download(new App\Exports\ExcelViewExport("excel.excel_fiscalias", ['peticiones'=>$peticiones,'unidades'=>$unidades,'petfiscalias'=>$petfiscalias]),'consulta_peticiones_fis.xlsx');



});

Route::post('get-user','UserController@get_user')->name('get_modelo_user');
Route::post('get-perito','PeritoController@get_perito');

Route::post('prestamo-o-baja-masiva/{tipo}','PrestamoController@masivo_tipo');



Route::post('cadena-reset/{cadena}','EntradaAccionController@cadena_reset');


Route::get('side-nav',function(){
   return view('plantilla.side_nav');
});



Route::post('get-solicitudes-form-select/{especialidad_id}','SolicitudController@get_solicitudes_form_select');

Route::get('necro-actualizar-clasificacion',function(){
   App\Necropsia::where('necropsia_tipo','dolosa')
                  ->update(['necropsia_clasificacion_id' => 1]);
   App\Necropsia::where('necropsia_tipo','hecho_transito')
                  ->update(['necropsia_clasificacion_id' => 2]);
   App\Necropsia::where('necropsia_tipo','patologia_otra')
                  ->update(['necropsia_clasificacion_id' => 3]);
   App\Necropsia::where('necropsia_tipo','suicidio')
                  ->update(['necropsia_clasificacion_id' => 4]);

});






















































#***************** PROYECTO DE MUESTREO PARA GENETICA****************************
#MUESTRAS
Route::get('muestra-form/{formAccion}/{muestra?}','Muestra\MuestraController@muestra_form')->name('muestra_form');
//Route::get('peticion-form/{formAccion}/{peticion?}','Peticion2Controller@peticion_form')->name('peticion_form');
//muestra la vista para iniciar el registro de la etapa codifcación
Route::get('muestras-inicio','Muestra\MuestraController@muestra_entradas')->name('muestra_entradas');

// form para el registro codificacion con multiple indicios; formAccion => 'codificacion'
Route::get('codificacion-multipleindicios-form/{formAccion}/{cadenas}','Muestra\CodificacionController@codificacion_multipleindicios_form')->name('codificacion_multipleindicios_form');























#ARMAS
Route::get('arma-form/{formAccion}/{modelo}/{modelo_id?}','Arma\ArmaController@arma_form')->name('arma_form')/*->middleware('colectivoEditar')*/;

Route::post('arma-save/{accion}/{modelo}/{modelo_id}','Arma\ArmaController@arma_save');
Route::get('arma-acuse-pdf/{cadena}','Arma\ArmaPDFController@arma_acuse');

//vista lista de armas
Route::get('arma-consultar','Arma\ArmaController@arma_consultar')->name('arma_consultar');
Route::get('arma-consultar2','Arma\ArmaController@arma_consultar2')->name('arma_consultar_dos');
//vista y acciones del modal
Route::post('acciones-modal/{arma}','Arma\ArmaController@acciones_modal');
//vista y acciones del modal realacion arma-indicio
Route::post('acciones-modal-relacion/{indicio}','Arma\ArmaController@realacion_arma_indicio');


//return vistas
Route::post('form-indicio','CadenaController@form_indicio');
Route::post('fila-tabla-armas','Arma\ArmaController@fila_tabla_armas');
Route::post('fila-tabla-recoleccion','CadenaController@fila_tabla_recoleccion');
Route::post('fila-tabla-embalaje','CadenaController@fila_tabla_embalaje');
Route::post('fila-tabla-servidor-publico','CadenaController@fila_tabla_servidor_publico');

#get-Modelo
   //unidad
   Route::post('get-modelo-unidad','GetModeloController@get_modelo_unidad')->name('get_modelo_unidad');



Route::get('indicios-cantidad-disponible',function(){
   App\Indicio::where('numero_indicios','<>',null)->update(['indicio_cantidad_disponible' => DB::raw('numero_indicios')]);
});

Route::get('prestamos-cantidad-indicios',function(){
   set_time_limit(0);
   ini_set('memory_limit', '-1');
   foreach (App\Prestamo::all() as $key => $prestamo) {
      foreach ($prestamo->indicios as $key => $indicio) {
         if ($indicio->pivot->prestamo_cantidad_indicios == null) {
            $prestamo->indicios()->updateExistingPivot($indicio->id, ['prestamo_cantidad_indicios' => $indicio->numero_indicios]);            
         }
         if ($prestamo->estado == 'concluso' && $indicio->pivot->reingreso_cantidad_indicios == null) {
            $prestamo->indicios()->updateExistingPivot($indicio->id, ['reingreso_cantidad_indicios' => $indicio->numero_indicios]);
         }
         // $indicio->save();
      }
   }

   echo 'listo';
});

Route::get('llenado-tabla-pivote-baja-indicio',function(){
   set_time_limit(0);
      ini_set('memory_limit', '-1');

      $bajas = App\Baja::whereIn('tipo',['parcial','definitiva'])->get();
      foreach ($bajas as $i => $baja) {
         foreach ($baja->indicios as $key => $indicio) {
            if($indicio->numero_indicios) DB::insert('insert into dbo.baja_indicio (baja_id, indicio_id, baja_cantidad_indicios, baja_tipo) values (?, ?, ?, ?)', [$baja->id, $indicio->id, $indicio->numero_indicios, 'completa']);
            else dd($indicio->id);
         }
         $baja->numero_indicios = $baja->indicios->sum('numero_indicios');
         $baja->save();
      }
      dd('hay vamos');
});


Route::get('llenado-campo-cantidad-disponible-tabla-indicios',function(){
   //llenado del campo indicio_cantidad_disponible de la tabla indicios
   App\Indicio::where('numero_indicios','<>',null)->update(['indicio_cantidad_disponible' => DB::raw('numero_indicios')]);
});


Route::get('indicios-region',function(){
	$indicios = App\Indicio::whereHas('cadena',function($q){
                        $q->where('fiscalia_id',8)
                        ->whereHas('entrada',function($a){
                           $a->whereBetween('fecha',['2021-01-01','2021-12-31']);
                        });
							})
							->get();
	
	dd($indicios->sum('numero_indicios'));
});

Route::get('prestamo-region',function(){
   $prestamos = App\Prestamo::whereBetween('prestamo_fecha',['2021-01-01','2021-31-12'])
                           ->whereHas('cadena',function($q){
                              $q->where('fiscalia_id',8);
                           })
                           ->get();
   dd(
      $prestamos->sum(function($prestamo){
         return $prestamo->indicios->sum('numero_indicios');
      })
   );
});
Route::get('baja-region',function(){
   $bajas = App\Baja::whereBetween('fecha',['2021-01-01','2021-31-12'])
                           ->whereHas('cadena',function($q){
                              $q->where('fiscalia_id',8);
                           })
                           ->get();
   dd(
      $bajas->sum('numero_indicios')
   );
});

Route::get('promerdio',function(){
   $indicios = App\Indicio::whereHas('cadena',function($q){
                                 $q->where('estado','validada')
                                 ->where('fiscalia_id',4)
                                 ->whereHas('entrada',function(){
                                    whereBetween('fecha',['2021-01-01','2021-12-31']);
                                 });
                              })
                              ->ge();

dd($indicios->sum('num_indicios'));
                              
                  
});


#indicio
   // Route::get('indicio-inventario','IndicioController@indicio_inventario');
   Route::get('indicio-inventario','InventarioController@indicio_inventario');
   Route::get('ingresos-prestamos-bajas','InventarioController@ingresos_prestamo_bajas');




Route::get('cadena-naturaleza',function(){
   set_time_limit(0);
      ini_set('memory_limit', '-1');
   // App\Cadena::where('active', 1)
   //        ->where('destination', 'San Diego')
   //        ->update(['naturaleza_id' => function($q){
   //          $q->whereHas('entrada',)
   //        }]);

   $cadenas = App\Cadena::where('naturaleza_id',null)->whereIn('estado',['validada','bloqueada'])->get();
   foreach ($cadenas as $key => $cadena) {
      if (!$cadena->entrada) {
         dd($cadena->id);
      }
      $cadena->naturaleza_id = $cadena->entrada->naturaleza_id;
      $cadena->save();
   }

   // App\Cadena::where('estado','validada')
   //             ->update(['naturaleza_id' => ])
});




Route::get('poa',function(){
   foreach (App\Fiscalia::all() as $key => $fiscalia) {
      echo "{$fiscalia->nombre} <br>";
      $prestamos = App\Prestamo::whereBetween('created_at',['2022-01-01 00:00:00','2022-01-31 23:59:59'])
                     ->whereHas('cadena',function($q) use($fiscalia){
                        $q->where('fiscalia_id',$fiscalia->id);
                     })                  
                     ->sum('prestamo_numindicios');
   
      $bajas = App\Baja::whereBetween('created_at',['2022-01-01 00:00:00','2022-01-31 23:59:59'])
                        ->whereHas('cadena',function($q) use($fiscalia){
                           $q->where('fiscalia_id',$fiscalia->id);
                        })
                        ->sum('numero_indicios');
   
      $indicios = App\Indicio::whereHas('cadena',function($q) use($fiscalia){
                                 $q->where('fiscalia_id',$fiscalia->id)
                                 ->whereHas('entrada',function($a){
                                    $a->whereBetween('created_at',['2022-01-01 00:00:00','2022-01-31 23:59:59'])->where('tipo','indicio');
                                 });
                              })
                              ->sum('numero_indicios');
      $evidencias = App\Indicio::whereHas('cadena',function($q) use($fiscalia){
                                 $q->where('fiscalia_id',$fiscalia->id)
                                 ->whereHas('entrada',function($a){
                                    $a->whereBetween('created_at',['2022-01-01 00:00:00','2022-01-31 23:59:59'])->where('tipo','evidencia');
                                 });
                              })
                              ->sum('numero_indicios');
   
      echo "indicios: {$indicios} <br>";
      echo "evidencias: {$evidencias} <br>";
      echo "prestamos: {$prestamos} <br>";
      echo "bajas: {$bajas} <br>";
      echo "---------------- <br>";
      # code...
   }
   
});