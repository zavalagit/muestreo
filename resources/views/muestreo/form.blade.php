<div class="row">

    <div class="col s12">
        <table>
            <tr>
                <td>
                    <div class="input-field">
                        <input type="date" id="fecha" class="center-align" name="fecha">
                        <label class="active" for="fecha"><i class="fas fa-calendar-alt"></i> ~ FECHA</label>
                    </div>
                </td>
            </tr>
        </table>
    </div>

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
    <!--fotos o diagramas-->
    <div class="input-field col l1">
        <p>Foto(s) o diagrama(s)</p>
    </div>
    <div class="input-field col l1">
        <label>
            <input type="radio" name="fotos_diagramas" value="1" />
            <span>Sí</span>
        </label>
    </div>
    <div class="input-field col l1">
        <label>
            <input type="radio" name="fotos_diagramas" value="0" />
            <span>No</span>
        </label>
    </div>
    <!--observaciones sobre el muestreo-->
    <div class="col s12">
        <!--primer renglon-->
        <div class="row">
            <div class="col s12">
                Observaciones sobre el muestreo:
            </div>
            <div class="input-field col l2">
                Se observa un fragmento de 
            </div>
            <div class="col l2">
                <select>
                    <option value="" disabled selected>Choose your option</option>
                    <option value="1">Option 1</option>
                    <option value="2">Option 2</option>
                    <option value="3">Option 3</option>
                </select>
                <label>Materialize Select</label>
            </div>
            <div class="input-field col l2">
                para su análisis.
            </div>
        </div>
        <!--segundo renglon-->
        <div class="row">
            <div class="input-field col l3">
                Se realiza una limpieza del hueso y se toma un fragmento de 
            </div>
            <div class="col l2">
                <select>
                    <option value="" disabled selected>Choose your option</option>
                    <option value="1">Option 1</option>
                    <option value="2">Option 2</option>
                    <option value="3">Option 3</option>
                </select>
                <label>Materialize Select</label>
            </div>
            <div class="input-field col l2">
                para su análisis.
            </div>
        </div>
        <!--tercer renglon-->
        <div class="row">
            <div class="input-field col l1">
                <p>Otro:</p>
            </div>
            <div class="input-field col l11">                        
                <input placeholder="Placeholder" id="first_name" type="text" class="validate">                
            </div>
        </div>
    </div>    
    <!--supervision-->
    <div class="input-field col l12">
        <input type="text" id="supervision" name="supervision">
        <label for="supervision"><i class="fas fa-folder"></i> ~ Supervisión</label>
    </div>
    <!--descalcificacion-->
    <div class="col l3">
        <div class="row">
            <div class="input-field col l4">
                <p>Descalicificación:</p>
            </div>    
            <div class="input-field col l2">
                <label>
                    <input type="radio" name="descalsificacion" value="1" />
                    <span>Sí</span>
                </label>
            </div>
            <div class="input-field col l2">
                <label>
                    <input type="radio" name="descalsificacion" value="0" />
                    <span>No</span>
                </label>
            </div>
            <div class="input-field col l4">
                <label>
                    <input type="radio" name="descalsificacion" value="" />
                    <span>NA</span>
                </label>
            </div>
        </div>
    </div>
    <!--dias en descalcificción-->
    <div class="col l2">
        <div class="row">
            <div class="input-field col l12">
                <input type="number" id="descalsificacion-dias" name="descalsificacion_dias">
                <label for="descalsificacion-dias"><i class="fas fa-folder"></i> ~ Días en descalsificación</label>
            </div>
        </div>
    </div>
    <!--alcohol secado-->
    <div class="col l3">
        <div class="row">
            <div class="input-field col l4">
                <p>Alcohol (secado):</p>
            </div>
            <div class="input-field col l2">
                <label>
                    <input type="radio" name="alcohol" value="1" />
                    <span>Sí</span>
                </label>
            </div>
            <div class="input-field col l2">
                <label>
                    <input type="radio" name="alcohol" value="0" />
                    <span>No</span>
                </label>
            </div>
            <div class="input-field col l4">
                <label>
                    <input type="radio" name="alcohol" value="" />
                    <span>NA</span>
                </label>
            </div>
        </div>
    </div>

    <div class="col l4">
        <div class="row">
            <div class="input-field col l3">
                <p>Tecnica utilizada:</p>
            </div>
            <div class="input-field col l2">
                <label>
                    <input type="radio" name="tecnica_utilizada" value="laminado" />
                    <span>Laminado</span>
                </label>
            </div>
            <div class="input-field col l2">
                <label>
                    <input type="radio" name="tecnica_utilizada" value="otro" />
                    <span>Otro:</span>
                </label>
            </div>
            <div class="input-field col l5">
                <input type="text" id="first_name">
            </div>
        </div>
    </div>
</div>

{{-- <div class="row {{ !in_array($formAccion,['editar','clonar']) ? 'ocultar' : ''}}"> --}}
<div class="row">
    <div class="col s12 m12 l2 offset-l10">
        <button type="submit" class="btn-guardar">guardar</button>
    </div>
</div>