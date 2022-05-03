$(function () {

   /**
    * Ejemplo del btn (etiqueta "a") o activador del modal
       <a href="" class="btn-anexo e-documento"
           data-cadena-id="{{$cadena->id}}"
           data-folio="{{$cadena->folio_bodega}}"
           data-nuc="{{$cadena->ci_pp}}"
           data-anexo-tipo="anexo-3"
           dat-url="{{route('cadena_anexo3',['cadena'=>$cadena])}}" 
       >
       <i class="fas fa-file-pdf i-color"></i> <span class="i-referencia">Anexo 3</span>
       </a>

    * Agregar
       <!--modal anexos-->
       @include('modal.modal_anexos')

    * JS
       <script type="text/javascript" src="{{asset('js/cadena/cadena_anexos_pdf.js')}}" ></script>
    */

   $('body').on('click', '.btn-anexo', function (e) {
      e.preventDefault();
      
      let folio = $(this).attr('data-folio');
      let nuc = $(this).attr('data-nuc');
      let anexo_tipo = $(this).attr('anexo_tipo');
      let url = $(this).attr('data-url');

      console.log(url);

      $('#form-anexo').attr('action', url);
      //agregando titulos
      $('.modal-anexo-header .header-titulo').empty();
      $('.modal-anexo-header .header-titulo').append(anexo_tipo);
      $('.modal-anexo-header .header-folio').empty();
      if (folio != '')
         $('.modal-anexo-header .header-folio').append(folio + ' - ' + nuc);
      else
         $('.modal-anexo-header .header-folio').append(nuc);
      //abriendo modal
      $('#modal-anexo').modal('open');
   });

});