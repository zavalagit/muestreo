<div class="row container">
   <div class="col s12">
      {{-- <h5>{{$encabezado}}</h5> --}}
   </div>
   <form id="form-foto" action="/foto-save/{{$modelo}}/{{$modelo_id}}" method="POST" enctype="multipart/form-data">
      {{ csrf_field() }}
      <div class="file-field input-field col s12">
         <div class="btn">
            <span>Foto(s)</span>
            <input type="file" id="foto" multiple required accept="image/jpeg,image/png" name="fotos[]">
         </div>
         <div class="file-path-wrapper">
            <input class="file-path validate" type="text" placeholder="Puede subir una o más fotos">
         </div>
      </div>
      <div class="input-field col s2">
         <button id="btn-foto" class="btn-submit" type="submit">GUARDAR</button>
      </div>
   </form>
</div>
