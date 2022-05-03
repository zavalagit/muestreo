<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> --}}
    {{-- <meta http-equiv="X-UA-Compatible" content="ie=edge"> --}}
    <title>Anexo 3</title>

    <!--css-->
    <link rel="stylesheet" href="<?php echo $_SERVER["DOCUMENT_ROOT"]; ?>/plugins/materialize-v1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="<?php echo $_SERVER["DOCUMENT_ROOT"]; ?>/css/cadena/cadena_anexo_pdf.css">
</head>
<body>
    
    <header>
        <table>
            <tr>
                <td rowspan="2" class="td-logo">
                    <img src="<?php echo $_SERVER["DOCUMENT_ROOT"]; ?>/logos/logo_IJCF.png"/>    
                </td>                
                <td class="td-justify" style="text-align:center; font-size: 13px; font-weight: bold; padding: 10px 0;">REGISTRO DE CADENA DE CUSTODIA</td>                
                <td rowspan="2" class="td-logo">
                    <img src="<?php echo $_SERVER["DOCUMENT_ROOT"]; ?>/logos/logo_jalisco_gobierno_estado.png"/>    
                </td> 
            </tr>
            <tr>
                <td>
                    <div style="float: left; text-align: center; width: 33%;">Código: I-F001</div>
                    <div style="float: left; text-align: center; width: 33%;">Versión: 06</div>
                    <div style="float: left; text-align: center; width: 34%;">Fecha:</div>
                </td>
            </tr>
        </table>

        <div>
            <div style="float:left; width:50%; text-align:left;">FECHA: {{$cadena->fecha_registro}}</div>
            <div style="float:left; width:50%; text-align:right;">(CI) (PP): {{$cadena->ci_pp}}</div>
        </div>
    </header>

    <footer>
        <div style="text-align: left">
            <div>Abreviaturas: CI: Carpeta de investigación &nbsp;&nbsp;&nbsp;&nbsp; PP: Procesamiento Penal</div>
        </div>
    </footer>

    <main>

        <section>
            <div style="">
                <div style="float:left; width:70%;">Autoridad investigadora: Agencia {{$cadena->unidad_id}}</div>
                <div style="float:left; width:30%;">AMP: {{$cadena->amp}}</div>
            </div>
        </section>

        <section id="seccion-uno">            
            <table>
                <tr class="tr-grid" style="">
                    <td width="5%"></td>    
                    <td width="5%"></td>    
                    <td width="5%"></td>    
                    <td width="5%"></td>    
                    <td width="5%"></td>    
                    <td width="5%"></td>    
                    <td width="5%"></td>    
                    <td width="5%"></td>    
                    <td width="5%"></td>    
                    <td width="5%"></td>                        
                    <td width="5%"></td>    
                    <td width="5%"></td>    
                    <td width="5%"></td>    
                    <td width="5%"></td>    
                    <td width="5%"></td>    
                    <td width="5%"></td>    
                    <td width="5%"></td>    
                    <td width="5%"></td>    
                    <td width="5%"></td>    
                    <td width="5%"></td>                        
                </tr>
                <tr>
                    <td colspan="20" class="td-seccion">1.- ANTECEDENTES DEL EVENTO Y ORIGEN DE LOS INDICIOS</td>    
                </tr>            
                <tr>
                    <td colspan="3">Tipo de servicio:</td>
                    <td colspan="17">{{$cadena->servicio}}</td>
                </tr>
                <tr>
                    <td colspan="3">Calle (Edificio):</td>
                    <td colspan="7">{{$cadena->calle1}}</td>
    
                    <td colspan="2">Núm Ext:</td>
                    <td colspan="3">{{$cadena->numero_exterior}}</td>
                    
                    <td colspan="2">Núm Int:</td>
                    <td colspan="3">{{$cadena->numero_interior}}</td>
                </tr>
                <tr>
                    <td colspan="3">Entre la calle:</td>
                    <td colspan="7">{{$cadena->calle2}}</td>
    
                    <td colspan="3">y la calle:</td>
                    <td colspan="7">{{$cadena->calle3}}</td>                
                </tr>
                <tr>
                    <td colspan="3">Colonia:</td>
                    <td colspan="7">{{$cadena->colonia}}</td>
    
                    <td colspan="3">Municipio:</td>
                    <td colspan="7">{{$cadena->municipio_id}}</td>                
                </tr>
                <tr>
                    <td colspan="4">Otras referencias:</td>
                    <td colspan="16">{{$cadena->referencias}}</td>                
                </tr>

                <thead>
                    <tr>
                        <th colspan="8">Nombre(s) del (los) servidor(es) público(s) que inicia(n) la cadena de custodia</th>
                        <th colspan="4">Institución, Cargo y # de Identificación</th>
                        <th colspan="3">Etapa</th>
                        <th colspan="5">Firma</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cadena->users as $user)
                        <tr>
                            <td colspan="8">{{$user->name}}</td>
                            <td colspan="4">{{$user->cargo->nombre}}</td>
                            <td colspan="3">{{$user->pivot->etapa}}</td>
                            <td colspan="5"></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>

        <section id="seccion-dos">
            <table>
                <tr class="tr-grid">
                    <td width="5%"></td>    
                    <td width="5%"></td>    
                    <td width="5%"></td>    
                    <td width="5%"></td>    
                    <td width="5%"></td>    
                    <td width="5%"></td>    
                    <td width="5%"></td>    
                    <td width="5%"></td>    
                    <td width="5%"></td>    
                    <td width="5%"></td>                        
                    <td width="5%"></td>    
                    <td width="5%"></td>    
                    <td width="5%"></td>    
                    <td width="5%"></td>    
                    <td width="5%"></td>    
                    <td width="5%"></td>    
                    <td width="5%"></td>    
                    <td width="5%"></td>    
                    <td width="5%"></td>    
                    <td width="5%"></td>                        
                </tr>
                <tr>
                    <td colspan="20" class="td-seccion">2.- CONDICIONES DE RECOLECCIÓN, PRESERVACIÓN Y TRASLADO</td>                
                </tr>
                <thead>
                    <tr>
                        <th colspan="5">Clima</th>
                        <th colspan="11">Iluminación</th>
                        <th colspan="4">Temperatura</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Seco</td>
                        <td colspan="2">Nublado</td>
                        <td colspan="2">Lluvioso</td>

                        <td colspan="2">Natural</td>
                        <td colspan="2">Artificial</td>
                        <td colspan="2">Buena</td>
                        <td colspan="2">Regular</td>
                        <td colspan="2">Escasa</td>
                        <td>Mala</td>

                        <td>Fria</td>
                        <td colspan="2">Templado</td>
                        <td>Calor</td>
                    </tr>
                </tbody>
                <tr>
                    <th colspan="3">Traslado:</th>
                    <td colspan="2">Abierto</td>
                    <td colspan="2">Cerrado</td>
                    <td colspan="2">T. Fría</td>
                    <td colspan="2">T. Ambiente</td>
                    <td colspan="1" class="td-border-right-none">Otros:</td>
                    <td colspan="8" class="td-border-left-none"></td>
                </tr>
            </table>
        </section>

        <section id="seccion-tres">
            <table>
                <tr class="tr-grid">
                    <td width="5%"></td>    
                    <td width="5%"></td>    
                    <td width="5%"></td>    
                    <td width="5%"></td>    
                    <td width="5%"></td>    
                    <td width="5%"></td>    
                    <td width="5%"></td>    
                    <td width="5%"></td>    
                    <td width="5%"></td>    
                    <td width="5%"></td>                        
                    <td width="5%"></td>    
                    <td width="5%"></td>    
                    <td width="5%"></td>    
                    <td width="5%"></td>    
                    <td width="5%"></td>    
                    <td width="5%"></td>    
                    <td width="5%"></td>    
                    <td width="5%"></td>    
                    <td width="5%"></td>    
                    <td width="5%"></td>                        
                </tr>
                <tr>
                    <td colspan="20" class="td-seccion">3.- IDENTIFICACIÓN Y DESCRIPCIÓN DE INDICIOS</td>
                </tr>
                <thead>
                    <tr>
                        <th colspan="2">No. Pregresivo</th>
                        <th colspan="2">No. De Indicio</th>
                        <th>Cantidad</th>
                        <th colspan="8">Descripcion/Nombre del Indicio</th>
                        <th colspan="2">Tipo de embalaje</th>
                        <th colspan="5">Observaciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cadena->indicios as $i => $indicio   )
                        <tr>
                            <td colspan="2" class="td-center">{{$i + 1}}</td>
                            <td colspan="2">{{$indicio->identificador}}</td>
                            <td>{{$indicio->cantidad}}</td>
                            <td colspan="8">{{$indicio->descripcion}}</td>
                            <td colspan="2">{{$indicio->embalaje}}</td>
                            <td colspan="5">{{$indicio->observaciones}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>

        <section id="seccion-cuatro" style="page-break-before: always;">
            <table>
                <tr class="tr-grid">
                    <td width="5%"></td>    
                    <td width="5%"></td>    
                    <td width="5%"></td>    
                    <td width="5%"></td>    
                    <td width="5%"></td>    
                    <td width="5%"></td>    
                    <td width="5%"></td>    
                    <td width="5%"></td>    
                    <td width="5%"></td>    
                    <td width="5%"></td>                        
                    <td width="5%"></td>    
                    <td width="5%"></td>    
                    <td width="5%"></td>    
                    <td width="5%"></td>    
                    <td width="5%"></td>    
                    <td width="5%"></td>    
                    <td width="5%"></td>    
                    <td width="5%"></td>    
                    <td width="5%"></td>    
                    <td width="5%"></td>                        
                </tr>
                <tr>
                    <td colspan="20" class="td-seccion">4.- DATOS PERSONAS QUE INTERVIENEN EN EL SEGUIMIENTO DE LA CADENA DE CUSTODIA</td>
                </tr>
                <thead>
                    <tr>
                        <th colspan="4">Nombre de quien recibe</th>
                        <th colspan="2">Cargo / # ID</th>
                        <th colspan="3">Dependencia</th>
                        <th colspan="3">Proceso</th>
                        <th colspan="3">Progresivo</th>
                        <th colspan="2">Fecha y hora</th>
                        <th colspan="3">Firma</th>
                    </tr>                                        
                </thead>
                <tbody>
                    @for ($i = 0; $i < 10; $i++)
                        <tr>
                            <td colspan="4"></td>
                            <td colspan="2"></td>
                            <td colspan="3"></td>
                            <td colspan="3"></td>
                            <td colspan="3"></td>
                            <td colspan="2"></td>
                            <td colspan="3"></td>
                        </tr>
                    @endfor
                </tbody>
            </table> 
        </section>

        <section>
            <table>
                <tr class="tr-grid"><td></td></tr>
                <tr>
                    <td class="td-seccion">EXCLUSIVO INSTITUTO JALISCIENSE CIENCIAS FORENSES</td>
                </tr>
                <tr>
                    <td class="td-seccion">5.- SOBRE EL ANÁLISIS PERICIAL</td>
                </tr>
                <tr>
                    <td class="td-seccion">(Observaciones particulares sobre los indicios: peritaje irreproducible, si hubo alteraciones en los mismos, etc.)</td>
                </tr>
                <tr>
                    <td style="padding:58px 0;"> <!--Espacio grande--> </td>
                </tr>
            </table>
        </section>
        
        <section>
            <table>
                <tr class="tr-grid"><td></td></tr>
                <tr>
                    <td class="td-seccion">6.- OBSERVACIONES DE ALTERACIONES AL SISTEMA DE CADENA DE CUSTODIA</td>
                </tr>
                <tr>
                    <td style="padding:58px 0;"> <!--Espacio grande--> </td>
                </tr>
            </table>
        </section>
    </main>

</body>
</html>