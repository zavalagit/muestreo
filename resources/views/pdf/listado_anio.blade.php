{{-- <table>
    <thead>
        <tr>
            <th>No.</th>
            <th>Fecha de creación del registro</th>
            <th>Usuario</th>
            <th>N.U.C.</th>
            <th>Especialidad</th>
            <th>Solicitud</th>
            <th>Fecha recepción</th>
            <th>Fecha elaboración</th>
            <th>Fecha entrega</th>
            <th>Documento emitido</th>
            <th>Estidios</th>
        </tr>
    </thead>
    <tbody>
        @php
            $no = 1;
        @endphp
        @foreach ($peticiones->sortBy('created_at') as $key => $peticion)
            <tr>
                <td>{{$no++}}</td>
                <td>{{$peticion->created_at}}</td>
                <td>{{$peticion->user->name}}</td>
                <td>{{$peticion->nuc}}</td>
                <td>{{$peticion->solicitud->especialidad->nombre}}</td>
                <td>{{$peticion->solicitud->nombre}}</td>
                <td>{{$peticion->fecha_recepcion}}</td>
                <td>{{$peticion->fecha_elaboracion}}</td>
                <td>{{$peticion->fecha_entrega}}</td>
                <td>{{$peticion->documento_emitido}}</td>
                <td>{{$peticion->cantidad_estudios}}</td>
            </tr>
        @endforeach
    </tbody>
</table> --}}

<table>
    <thead>
        <tr>
            <th>Folio</th>
            <th>cadena_id</th>
            <th>indicio identificador</th>
            <th>indicio_id</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cadenas as $i => $cadena)
            @foreach ($cadena->indicios as $indicio)
                <tr>
                    <td>{{$cadena->folio_bodega}}</td>
                    <td>{{$cadena->id}}</td>
                    <td>{{$indicio->identificador}}</td>
                    <td>{{$indicio->id}}</td>
                </tr>
            @endforeach
        @endforeach
    </tbody>
</table>

