<div class="col s12">
    <p style="font-size: 18px;"><b>- Seleccione el tipo de etiqueta:<b></p>
 </div>
 <div class="col s12 div-col-padding">
    <label for="etiqueta-general">
       <input type="checkbox" class="filled-in" id="etiqueta-general" checked name="etiqueta_general"/>
       <span>Etiqueta general (Indicios en una sola etiqueta)</span>
    </label>
 </div>
 
 @if ($cadena->indicios->count() > 1)
    <div class="col s12 div-col-padding">
       <label for="etiqueta-identificador">
          <input type="checkbox" class="filled-in" id="etiqueta-identificador" disabled name="etiqueta_identificador"/>
          <span>Etiqueta por identificador (Una etiqueta por cada identificador)</span>
       </label>
    </div>
 @endif
 
 @if ($cadena->indicios->count() > 2)
    <div class="col s12">
       <p style="font-size: 18px;"><b>- Etiqueta personalizada ~ seleccione los identificadores de los indicios que quiere que figuren en la etiqueta:<b></p>
    </div>
    @foreach ($cadena->indicios as $indicio)
        <div class="col s12 div-col-padding">
           <label for="indicio-{{$indicio->id}}">
             <input type="checkbox" class="etiqueta-indicio filled-in" id="indicio-{{$indicio->id}}" disabled name="etiqueta_indicios[]" value="{{$indicio->id}}"/>
             <span>{{$indicio->identificador}}</span>
          </label>
        </div>
    @endforeach
 @endif
 
 <div class="col s12">
    <p style="font-size: 18px;"><b>- Indique el tamaño de la etiqueta:<b></p>
 </div>
 <div class="col s12 div-col-padding">
    <label for="chica">
       <input type="radio" id="chica" required name="etiqueta_tamano" value="chica"/>
       <span>Chica</span>
    </label>
 </div>
 <div class="col s12 div-col-padding">
    <label for="mediana">
       <input type="radio" id="mediana" checked name="etiqueta_tamano" value="mediana"/>
       <span>Mediana</span>
    </label>
 </div>
 <div class="col s12 div-col-padding">
    <label for="grande">
       <input type="radio" id="grande" name="etiqueta_tamano" value="grande"/>
       <span>Grande</span>
    </label>
 </div>
 
 <div class="col s12">
    <hr class="hr-main">
 </div>
 
 <div class="input-field col s12">
    <button type="submit" class="btn-guardar" id="btn-buscar" style="display: inline-block !important; width:100%;" name="btn" value="buscar">Generar etiqueta</button>
 </div>
 