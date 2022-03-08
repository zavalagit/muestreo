<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\FotoFormRequest;
use Illuminate\Support\Facades\Storage;
use App\Baja;
use App\Cadena;
use App\Entrada;
use App\Foto;
use App\Prestamo;

class FotoController extends Controller
{
    const DISK = 'public';
    private $modelo;
    private $modelo_id;
    private $directorio_raiz;
    private $cadena;

    public function foto_form($modelo, $modelo_id){
        // $fotos = Storage::disk(self::DISK)->files('fotos_indicios/'.$cadena->folio_bodega.'/entrada'.'/'.$cadena->entrada->id);

        return view('foto.foto_form',compact('modelo','modelo_id'));
    }
    public function foto_save(FotoFormRequest $request, $modelo, $modelo_id){ #1
        $this->set_atributos($modelo,$modelo_id); #2
        $this->set_modelo(); #3
        $this->set_cadena(); #4
        $this->set_directorio(); #5
        ($modelo == 'arma') ? $this->foto_estructura_directorio_arma() : $this->foto_estrucura_directorios(); #6
        $this->foto_storage($request); #7
        $this->foto_bdd(); #8
            
        return response()->json([
            'status' => true,
        ]);
    }
    private function set_atributos($modelo,$modelo_id){ #2
        $this->modelo = $modelo;
        $this->modelo_id = $modelo_id;
    }
    private function set_modelo(){ #3
        switch ($this->modelo)
            {
            case 'entrada':
                $this->entrada = Entrada::find($this->modelo_id);                
                break;
            case 'prestamo':
                $this->prestamo = Prestamo::find($this->modelo_id);
                break;        
            case 'baja':
                $this->baja = Baja::find($this->modelo_id);            
                break;        
            default:
                # code...
                break;
            }
    }
    private function set_cadena(){ #4
        switch ($this->modelo)
            {
            case 'entrada':
                $this->cadena = Cadena::find($this->entrada->cadena_id);
                break;
            case 'prestamo':                
                $this->cadena = Cadena::find($this->prestamo->cadena_id);
                break;        
            case 'baja':                
                $this->cadena = Cadena::find($this->baja->cadena_id);
                break;        
            default:
                # code...
                break;
            }
    }
    private function set_directorio(){ #5
        if($this->modelo == 'arma') $this->directorio_raiz = "fotos_armas/{$this->modelo_id}";
        else $this->directorio_raiz = "fotos_indicios/{$this->cadena->folio_bodega}/{$this->modelo}/{$this->modelo_id}";
    }
    public function foto_estrucura_directorios(){ #6
        $directorio_folio = "fotos_indicio/{$this->cadena->folio_bodega}";
        if( !Storage::disk(self::DISK)->exists($directorio_folio) ){
            //directorio folio
            Storage::disk(self::DISK)->makeDirectory($directorio_folio);
            //directorio entradas
            Storage::disk(self::DISK)->makeDirectory($directorio_folio.'/entrada');
            //directorio prestamos
            Storage::disk(self::DISK)->makeDirectory($directorio_folio.'/prestamo');
            //directorio bajas
            Storage::disk(self::DISK)->makeDirectory($directorio_folio.'/baja');
        }        
    }
    private function foto_estructura_directorio_arma(){ #6
        if( !Storage::disk(self::DISK)->exists($this->directorio_raiz) ){
            //directorio('fotos_armas/arma_id')
            Storage::disk(self::DISK)->makeDirectory($this->directorio_raiz);
        }
    }
    public function foto_storage(Request $request){ #7
        foreach ($request->file('fotos') as $foto) {
                $ruta = $foto->store($this->directorio_raiz,self::DISK);
        }
    }
    public function foto_bdd(){ #8
        // $fotografias = Storage::disk(self::DISK)->files('fotos_indicios/'.$this->cadena->folio_bodega.'/'.$this->modelo.'/'.$this->modelo_id);
        $fotografias = Storage::disk(self::DISK)->files($this->directorio_raiz);
        foreach ($fotografias as $i => $fotografia) {
            $foto = new Foto;
            $foto->nombre = substr($fotografia, strrpos($fotografia,'/')+1 );
            $foto->fotografia_id = $this->modelo_id;
            $foto->fotografia_type = "App\\".ucwords($this->modelo);
            $foto->save();
        } 
    }

    
}
