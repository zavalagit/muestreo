@extends('plantilla.template_sin_menu')

@section('css')
   {{-- <link rel="stylesheet" href="{{asset('css/tablas.css')}}"> --}}
@endsection

@section('titulo')
    
@endsection

@section('contenido')
@if(!empty($errors->all()))
   <div>      
      @foreach ($errors->all() as $mensaje)
            <p>
               {{$mensaje}}
            </p>
      @endforeach
   </div>
@endif

   <div class="row container">
      <form action="/foto-save/{{$modelo}}/{{$modelo_id}}" method="POST" enctype="multipart/form-data">
         {{ csrf_field() }}
         <div class="file-field input-field col s12">
            <div class="btn">
               <span>Foto(s)</span>
               <input type="file" multiple accept="image/jpeg,image/png" name="fotos[]">
            </div>
            <div class="file-path-wrapper">
               <input class="file-path validate" type="text" placeholder="Puede subir una o más fotos">
            </div>
         </div>
         <div class="input-field col s2">
            <button type="submit">Guardar</button>
         </div>
      </form>
   </div>

   {{-- <div class="row container">
      <div class="col s12">
         <hr class="hr-2">
      </div>
   </div>

   <div class="row container">
      <div class="col s12">
         @forelse ($cadena->prestamos as $prestamo)
            <table>
               <caption style="background-color: #c09f77; color: #152f4a; font-weight: bold; text-align: left; padding-left: 10px;">PRESTAMOS</caption>
               <thead>
                  <tr>
                     <th colspan="2">Fecha prestamo</th>
                     <th colspan="2">Fecha rengreso</th>
                  </tr>
                  <tr>
                     <th>Nº</th>
                     <th>VER</th>
                     <th>NOMBRE</th>
                     <th>ELIMINAR</th>
                  </tr>
               </thead>
               <tbody>
                  
                     
               </tbody>
            </table>
         @empty
         
         @endforelse
      </div>
   </div>
   
   <hr class="hr-1">

   <div class="row container">
      <div class="col s12">
         <table>
            <caption style="background-color: #c09f77; color: #152f4a; font-weight: bold; text-align: left; padding-left: 10px;">BAJAS</caption>
            <thead>
               <tr>
                  <th>VER</th>
                  <th>NOMBRE</th>
                  <th>ELIMINAR</th>
               </tr>
            </thead>
            <tbody>
               @forelse ($cadena->bajas as $baja)
                  
               @empty
                  <tr>
                     <td colspan="3">No hay nada</td>
                  </tr>                  
               @endforelse
            </tbody>
         </table>
      </div>
   </div> --}}

   

   {{-- <form action="/target" class="dropzone" id="my-dropzone"></form> --}}
@endsection

@section('js')
   <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
   {{-- <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script> --}}

   {{-- <script>
      // Note that the name "myDropzone" is the camelized
      // id of the form.
      Dropzone.options.myDropzone = {
        // Configuration options go here
      };
    </script> --}}
@endsection