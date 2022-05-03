<!--Datos Sistema-->
{{-- <div id="datos-sistema">
   <h6 class="center-align"> <b>REGISTRO/CONSULTA DE CADENA DE CUSTODIA</b> </h6>
 </div> --}}

<!--submenu-->
<li class="item-menu">
   <ul class="collapsible expandable">
      <li>
         <div class="menu-header collapsible-header" style="margin-bottom:10px;"><i class="fas fa-circle"></i>CADENA DE CUSTODIA</div>
         
         <div class="menu-body collapsible-body">
            <ul>
               <li class="{{request()->route()->named('cadenas.create') ? 'item-selected' : ''}}">
                  <a href="{{route('cadenas.create')}}" class=""><i class="fas fa-edit"></i><span>REGISTRAR</span></a>
               </li>
               <hr class="hr-2">
               <li class="{{request()->route()->named('cadenas.index') ? 'item-selected' : ''}}">
                  <a href="{{route('cadenas.index')}}" id="vista-cadena-consultar" class=""><i class="fas fa-book-open"></i><span>CONSULTAR</span></a>
               </li>
            </ul>
         </div>

      </li>
   </ul>
</li>
<hr class="hr-4">
 {{-- @if (Auth::user()->unidad->coordinacion == 'si')
 <li class="link"><a href="/peticion-registrar" class=""><i class="fas fa-exchange-alt"></i>PETICIONES</a></li>         
@endif --}}