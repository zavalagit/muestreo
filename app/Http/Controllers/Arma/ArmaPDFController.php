<?php

namespace App\Http\Controllers\Arma;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PDF;
use App\Cadena;
class ArmaPDFController extends Controller
{
    public function __construct()
    {
        set_time_limit(0);
    }
    public function arma_acuse(Cadena $cadena){
        $pdf = PDF::loadView('arma.pdf.arma_acuse_pdf', compact('cadena'));
        return $pdf->stream();
    }
}
