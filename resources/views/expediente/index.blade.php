@extends('template.template')

@section('css')
    
@endsection

@section('tittle','Expedientes')

@section('header')
    
@endsection

@section('main')
    <div class="row">
        <div class="col s12">
            <table>
                <thead>
                    <tr>
                        <th>Nº</th>
                        <th>FOLIO</th>
                        <th>N.U.C.</th>
                        <th>TIPO</th>
                        <th>PROCESOS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($expedientes as $i => $expediente)
                        <tr>
                            <td>{{$i+1}}</td>
                            <td>{{$expediente->folio}}</td>
                            <td>{{$expediente->nuc}}</td>
                            <td>{{$expediente->tipo}}</td>
                            <td>
                                @foreach ($expediente->procesos as $proceso)
                                    {{$proceso->nombre}}<br>
                                @endforeach
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10">Realice una busqueda</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('js')
    
@endsection
