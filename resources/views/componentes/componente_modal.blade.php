<div id="{{$modal_nombre}}" class="modal">
   <div class="modal-cerrar right-align">
      <a href="#" class="btn-modal-cerrar"><i class="fas fa-window-close fa-lg" style="color:#d50000"></i></a>
   </div>
   {{-- <div class="row"> --}}
      <header id="modal-header" style="padding-left: 0 !important;">
         {{ $header }}
         <!--etiquetas p con la clase header-titulo-->
         {{-- <p class="header-titulo header-folio"></p>
         <p class="header-titulo">Acciones</p> --}}
      </header>
   {{-- </div> --}}
   <main id="modal-body" style="padding-left: 0 !important; padding-top: 50px;"> 
      {{ $main }}
   </main>
   <footer id="modal-footer" class="modal-acciones-footer" style="padding-left: 0 !important;">
      {{ $footer }}
   </footer>
</div>
