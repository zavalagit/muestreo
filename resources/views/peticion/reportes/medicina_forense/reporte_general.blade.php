<table>
   <thead>
      <tr>
         <th rowspan="2">No.</th>
         <th rowspan="2" style="background-color:#152f4a; color: #c09f77 !important;">ESPECIALIDAD</th>
         <th colspan="{{$fiscalias->count()+1}}" style="background-color:#152f4a; color: #c09f77 !important;">FISCALÍAS</th>  
      </tr>
      <tr>
         @foreach ($fiscalias->sortBy('nombre') as $fiscalia)
            <th style="background-color:#394049; color:#c09f77 !important;">{{$fiscalia->nombre}}</th>
         @endforeach
         <th style="background-color:#394049; color:#c09f77 !important;">TOTAL</th>
      </tr>
   </thead>
   <tbody>
      @foreach ($especialidades->sortBy('nombre')->values() as $i => $especialidad)
         <tr>
            <td>{{$i+1}}</td>
            <td style="background-color: yellow;">{{$especialidad->nombre}}</td>
            @foreach ($fiscalias->sortBy('nombre') as $j => $fiscalia)
               <td> {{$peticiones->where('fiscalia2_id',$fiscalia->id)->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->whereIn('documento_emitido',['dictamen','certificado'])->count()}} </td>
            @endforeach
            <td> {{$peticiones->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->whereIn('documento_emitido',['dictamen','certificado'])->count()}} </td>
         </tr>
      @endforeach
      <tr>
         <td>{{$i+2}}</td>
         <td style="background-color: orange;">Informes</td>
         @foreach ($fiscalias->sortBy('nombre') as $fiscallia)
            <td> {{$peticiones->where('fiscalia2_id',$fiscalia->id)->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->where('documento_emitido','informe')->count()}} </td>
         @endforeach
         <td> {{$peticiones->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->where('documento_emitido','informe')->count()}} </td>
      </tr>
      {{-- <tr>
         <td>{{$i+3}}</td>
         <td style="background-color: orange;">Archivo</td>
         @foreach ($fiscalias->sortBy('nombre') as $fiscallia)
            <td> {{$peticiones->where('fiscalia2_id',$fiscalia->id)->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->where('documento_emitido','archivo')->count()}} </td>
         @endforeach
         <td> {{$peticiones->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->where('documento_emitido','archivo')->count()}} </td>
      </tr>
      <tr>
         <td>{{$i+4}}</td>
         <td style="background-color: orange;">Salida juzgado</td>
         @foreach ($fiscalias->sortBy('nombre') as $fiscallia)
            <td> {{$peticiones->where('fiscalia2_id',$fiscalia->id)->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->where('documento_emitido','salida_juzgado')->count()}} </td>
         @endforeach
         <td> {{$peticiones->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->where('documento_emitido','salida_juzgado')->count()}} </td>
      </tr> --}}
   </tbody>
</table>
<br>
<table>
   <thead>
      <tr>
         <th rowspan="2">No.</th>
         <th rowspan="2" style="background-color:#152f4a; color: #c09f77 !important;">NECROPSIA</th>
         <th colspan="{{$fiscalias->count()+1}}" style="background-color:#152f4a; color: #c09f77 !important;">FISCALÍAS</th>  
      </tr>
      <tr>
         @foreach ($fiscalias->sortBy('nombre') as $fiscalia)
            <th style="background-color:#394049; color:#c09f77 !important;">{{$fiscalia->nombre}}</th>
         @endforeach
         <th style="background-color:#394049; color:#c09f77 !important;">TOTAL</th>
      </tr>
   </thead>
   <tbody>
      <tr>
         <td>1</td>
         <td>Medicina</td>
         @foreach ($fiscalias->sortBy('nombre') as $fiscalia)
            <td>{{$necro_peticiones->where('fiscalia2_id',$fiscalia->id)->where('unidad3_id',null)->count()}}</td>
         @endforeach
         <td>{{$necro_peticiones->where('unidad3_id',null)->count()}}</td>
      </tr>
      <tr>
         <td>2</td>
         <td>USPEC</td>
         @foreach ($fiscalias->sortBy('nombre') as $fiscalia)
            <td>{{$necro_peticiones->where('fiscalia2_id',$fiscalia->id)->where('unidad3_id',110)->count()}}</td>
         @endforeach
         <td>{{$necro_peticiones->where('unidad3_id',110)->count()}}</td>
      </tr>
      <tr>
         <td>3</td>
         <td>UECS</td>
         @foreach ($fiscalias->sortBy('nombre') as $fiscalia)
            <td>{{$necro_peticiones->where('fiscalia2_id',$fiscalia->id)->where('unidad3_id',66)->count()}}</td>
         @endforeach
         <td>{{$necro_peticiones->where('unidad3_id',66)->count()}}</td>
      </tr>
   </tbody>
</table>