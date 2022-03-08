@extends('plantilla.template')


@section('contenido')

<div class="row">
   <div class="col s1 l1 offset-s11 offset-l11">
      <a href="#" data-activates="buscador-sidenav" class="b-side-nav"><i class="fas fa-search"></i></a>
   </div>
</div>


<ul id="buscador-sidenav" class="side-nav" style="background-color: #152f4a;">
   <li><div class="subheader" style="color: #c09f77; background-color: #152f4a;"><h5 class="center-align"><b><i class="fas fa-search"></i> Buscar...</b></h5></div></li>
   <!--hr-->
   <li>
      <div class="row">
         <div class="col s12">
            <hr class="hr-4">
         </div>
      </div>
   </li>
   <!--form-->
   <li>
      <div class="row">
         <form class="col s12" action="">
            <div class="row" style="background-color: #c6c6c6; border-radius: 15px;">
               <div class="input-field col s12"> 
                  <input id="fecha-inicio" type="date" name="b_fecha_inicio" value="{{old('b_fecha_inicio')}}">
               </div>
               <div class="input-field col s12">
                  <input id="fecha-fin" type="date" name="b_fecha_termino" value="{{old('b_fecha_termino')}}">
                  <label class="active" for="fecha-fin">FECHA FIN</label>
               </div>
               <div class="input-field col s12">
                  <input id="buscar-input" type="text" placeholder="NUC, NÚMERO OFICIO, FOLIO INTERNO" name="b_texto" value="{{old('b_texto')}}">
               </div>
            </div>
         </form>
      </div>
   </li>
</ul>




 
@endsection


@section('js')
   <script>
      $(function(){
         $(".b-side-nav").sideNav();

         $('.b-side-nav').sideNav({
            menuWidth: 430, // Default is 300
            edge: '', // Choose the horizontal origin
            closeOnClick: true, // Closes side-nav on <a> clicks, useful for Angular/Meteor
            draggable: true, // Choose whether you can drag to open on touch screens,
            onOpen: function(el) { /* Do Stuff */ }, // A function to be called when sideNav is opened
            onClose: function(el) { /* Do Stuff */ }, // A function to be called when sideNav is closed
         });
      });

    </script>
@endsection