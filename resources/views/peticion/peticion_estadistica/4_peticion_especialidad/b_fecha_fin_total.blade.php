{{-- ELIMINAR-ARCHIVO --}}

<!--recibidas-->
<td>{{$recibidas->count()}}</td>
<!--atendidas-->
<td>{{$atendidas->count()}}</td>
<!--pendiente-->
<td>{{$pendientes->count()}}</td>
<!--dictamen-->
<td>{{$atendidas->where('documento_emitido','dictamen')->count()}}</td>
<!--certificado-->
<td>{{$atendidas->where('documento_emitido','certificado')->count()}}</td>
<!--informe-->
<td>{{$atendidas->where('documento_emitido','certificado')->count()}}</td>
<!--juzgado-->
<td>{{$atendidas->where('documento_emitido','salida_juzgado')->count()}}</td>
<!--archivo-->
<td>{{$atendidas->where('documento_emitido','archivo')->count()}}</td>
<!--estudios-->
<td>{{$atendidas->sum('cantidad_estudios')}}</td>