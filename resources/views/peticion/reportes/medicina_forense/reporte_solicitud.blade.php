@foreach ($especialidades->sortBy('nombre') as $especialidad)
   <table style="margin-top:1%; page-break-after:always;">
      <caption style="background-color:#394049 !important; color: #152f4a !important;"><b>{{mb_strtoupper($especialidad->nombre)}}</b></caption>
      <thead>
         <tr>
            <th rowspan="2">No.</th>
            <th rowspan="2" style="background-color:#152f4a; color: #c09f77 !important;">SOLICITUD</th>   
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
         @php $n = 1; @endphp
         @foreach ($especialidad->solicitudes->sortBy('nombre') as $solicitud)
            <tr>
               <td>{{$n++}}</td>
               <td style="text-align: justify; padding-right:5px !important; background-color: yellow;">{{$solicitud->nombre}}</td>
               @foreach ($fiscalias->sortBy('nombre') as $fiscalia)
                  <td>{{$peticiones->where('fiscalia2_id',$fiscalia->id)->where('solicitud_id',$solicitud->id)->whereIn('documento_emitido',['dictamen','certificado'])->count()}}</td>
               @endforeach
               <td>{{$peticiones->where('solicitud_id',$solicitud->id)->whereIn('documento_emitido',['dictamen','certificado'])->count()}}</td>
            </tr>
         @endforeach
         
         <tr>
            <td>{{$n++}}</td>
            <td style="background-color: orange;">INFORMES</td>
               @foreach ($fiscalias->sortBy('nombre') as $fiscalia)
                     <td>{{$peticiones->where('fiscalia2_id',$fiscalia->id)->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->where('documento_emitido','informe')->count()}}</td>
               @endforeach
            <td>{{$peticiones->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->where('documento_emitido','informe')->count()}}</td>
         </tr>

         <tr>
            <td>{{$n++}}</td>
            <td>TOTAL</td>
            @foreach ($fiscalias->sortBy('nombre') as $fiscalia)
               <td>{{$peticiones->where('fiscalia2_id',$fiscalia->id)->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->whereIn('documento_emitido',['dictamen','certificado','informe'])->count()}}</td>
            @endforeach
            <td>{{ number_format($peticiones->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->whereIn('documento_emitido',['dictamen','certificado','informe'])->count() ) }}</td>
         </tr>
      </tbody>   
   </table>
@endforeach