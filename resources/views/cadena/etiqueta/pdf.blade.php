<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge"> --}}
    <title>Document</title>

    <style>
        @page {
            margin: 10px 10px 10px 10px; /* t r b l */
        }

        div#etiqueta-contenedor{
            border:1px solid black;"
        }

        table{
            width: 100%;
            border-collapse: collapse;
            font-size:10px;
        }
        tr td.td-center{
            text-align: center;
        }
        table#table-body tr td{
            padding-left: 5px;
            border-top: 1px solid black;
        }
        table#table-body tr td:first-child{font-weight: bold;}


        /*etiqueta_chica*/
        div.contenedor-etiqueta-chica{width: 47%;}
        /*etiqueta_mediana*/
        div.contenedor-etiqueta-mediana{width: 61% !important;}
        table.table-etiqueta-mediana{font-size: 13px;}
        /*etiqueta_grande*/
        div.contenedor-etiqueta-grande{width: 100% !important;}
        table.table-etiqueta-grande{font-size: 17px;}
       



    </style>

</head>
<body>
    
    <div id="etiqueta-contenedor"
        class="{{old('etiqueta_tamano') == 'chica' ? 'contenedor-etiqueta-chica' : ''}} {{old('etiqueta_tamano') == 'mediana' ? 'contenedor-etiqueta-mediana' : ''}} {{old('etiqueta_tamano') == 'grande' ? 'contenedor-etiqueta-grande' : ''}}"
    >
        <div>
            <table class="{{old('etiqueta_tamano') == 'mediana' ? 'table-etiqueta-mediana' : ''}} {{old('etiqueta_tamano') == 'grande' ? 'table-etiqueta-grande' : ''}}">
                <tr>
                    <td align="left" width="30%">
                        <img src="<?php echo $_SERVER["DOCUMENT_ROOT"]; ?>/logos/logo_IJCF.png" width="100%"/>    
                    </td>                
                    <td align="center" width="45%" style="">
                        Instituto Jalisciense de Ciencias Forenses <br>
                        Criminalística de Campo <br>
                        INDICIOS
                    </td>                
                    <td align="right" width="20%">
                        <img src="<?php echo $_SERVER["DOCUMENT_ROOT"]; ?>/logos/logo_IJCF_2.png" width="100%"/>    
                    </td> 
                </tr>
            </table>
        </div>
        <div>
            <table id="table-body" class="{{old('etiqueta_tamano') == 'mediana' ? 'table-etiqueta-mediana' : ''}} {{old('etiqueta_tamano') == 'grande' ? 'table-etiqueta-grande' : ''}}">
                <tr>
                    <td width="35%">ASUNTO:</td>
                    <td></td>
                </tr>
                <tr>
                    <td width="35%">?:</td>
                    <td></td>
                </tr>
                <tr>
                    <td>UBICACIÓN:</td>
                    <td></td>
                </tr>
                <tr>
                    <td>FECHA:</td>
                    <td>{{$cadena->fecha_registro}}</td>
                </tr>
                <tr>
                    <td>AGENCIA:</td>
                    <td>{{$cadena->unidad->nombre}}</td>
                </tr>
                <tr>
                    <td>DE SOLICITUD:</td>
                    <td>?</td>
                </tr>
                <tr>
                    <td>CARPETA DE INVESTIGACIÓN:</td>
                    <td>{{$cadena->ci_pp}}</td>
                </tr>
                <tr>
                    <td colspan="2" class="td-border td-center" style="padding: 0;">DESCRIPCIÓN DE INDICIO</td>
                </tr>
                @foreach ($cadena->indicios as $indicio)
                    <tr>
                        <td colspan="2">{{$indicio->identificador}}: {{$indicio->descripcion}}</td>
                    </tr>
                @endforeach
                <tr><td colspan="2">&nbsp;</td></tr>
                <tr>
                    <td>PERITO:</td>
                    <td>{{$cadena->user->name}}</td>
                </tr>
            </table>
        </div>
    </div>

</body>
</html>