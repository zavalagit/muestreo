<div class="row">

    <!--fecha-->
    <div class="input-field col l2">
        <input type="date" id="fecha" class="center-align" name="fecha">
        <label class="active" for="fecha"><i class="fas fa-calendar-alt"></i> ~ FECHA</label>
    </div>
    <!--hora-->
    <div class="input-field col l2">
        <input type="time" id="hora" class="center-align" name="hora">
        <label class="active" for="hora"><i class="fas fa-calendar-alt"></i> ~ Hora</label>
    </div>

    <div class="col s12">
        <table>
            <tr>
                <td>Biomeck 400</td>
                <td>
                    <div>
                        <label>
                            <input type="radio" name="biomek_400" value="1"/>
                            <span>Si</span>
                        </label>
                    </div>
                </td>
                <td>
                    <div>
                        <label>
                            <input type="radio" name="biomek_400" value="0"/>
                            <span>No</span>
                        </label>
                    </div>
                </td>
                <td>
                    <div>
                        <label>
                            <input type="radio" name=""/>
                            <span>NA</span>
                        </label>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    
    <div class="col s12">
        <table>
            <tr>
                <td>
                    <div>
                        <label>
                            <input type="checkbox" name="r_lg_r007" value="1"/>
                            <span><b>R-LG-R007</b> Bitácora de PCR Genotipos</span>
                        </label>
                    </div>
                </td>
                <!--numero_libro-->
                <td rowspan="2">Libro No.</td>
                <td rowspan="2">
                    <input type="text" id="numero-libro" name="numero_libro">
                    {{-- <label for="numero-libro">Lote Kit Power Quant</label> --}}
                </td>
                <!--numero_hoja-->
                <td rowspan="2">Hoja No.</td>
                <td rowspan="2">
                    <input type="text" id="numero-hoja" name="numero_hoja">
                    {{-- <label for="numero-hoja">Lote Kit Power Quant</label> --}}
                </td>
            </tr>
            <tr>
                <td>
                    <div>
                        <label>
                            <input type="checkbox" name="r_lg_r009" value="1"/>
                            <span><b>R-LG-R009</b> Bitácora de PCR Haplotipos</span>
                        </label>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <div class="col s12">
        <table>
            <tr>
                <th>Número de Amplificación</th>
                <th>Kit</th>
                <th>Número de Lote</th>
                <th>Termociclador</th>
            </tr>
            <tr>
                <td>
                    <input type="text" id="numero-amplificacion" name="numero_amplificacion">
                    {{-- <label for="numero-amplificacion">Lote Kit Power Quant</label> --}}
                </td>
                <td>
                    <select name="kit_id">
                        <option value="" disabled selected>Seleccione un Kit</option>
                        @foreach ($kits->sortBy('nombre')->values() as $i => $kit)
                            <option value="{{$kit->id}}">{{$i+1}}. {{$kit->nombre}}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input type="text" id="numero_lote" name="numero_lote">
                    <label for="numero_lote">Número de Lote</label>
                </td>
                <td>
                    <select name="termociclador_id">
                        <option value="" disabled selected>Seleccione un termociclador</option>
                        @foreach ($termocicladores->sortBy('nombre')->values() as $i => $termociclador)
                            <option value="{{$termociclador->id}}">{{$i+1}}. {{$termociclador->nombre}}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <div class="input-field">
                        <textarea id="observaciones" class="materialize-textarea" name="observaciones"></textarea>
                        <label for="observaciones">Observaciones</label>
                    </div>
                </td>
            </tr>
            <tr>
                <td>Supervisión</td>
                <td colspan="3"></td>
            </tr>
        </table>
    </div>

</div>

{{-- <div class="row {{ !in_array($formAccion,['editar','clonar']) ? 'ocultar' : ''}}"> --}}
<div class="row">
    <div class="col s12 m12 l2 offset-l10">
        <button type="submit" class="btn-guardar">Guardar</button>
    </div>
</div>