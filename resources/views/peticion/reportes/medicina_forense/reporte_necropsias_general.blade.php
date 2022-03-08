{{-- <table>
   <thead>
      <tr>
         <th>No.</th>
         <th>AUTOPSIA MECANISMOS</th>   
         <th>MORELIA</th>   
         <th>USPEC</th>  
         <th>UECS</th>  
         @foreach ($fiscalias->sortBy('nombre') as $fiscalia)
           @continue($fiscalia->id == 4)
           <th>{{$fiscalia->nombre}}</th>
         @endforeach
         <th>TOTAL</th>
       </tr>
    </thead>
    <tbody> --}}
      @foreach ($necropsia_clasificaciones->sortBy('nombre') as $clasificacion)
         <table>
            <thead>
               <tr>
                  <th colspan="{{$fiscalias->count() + 5 }}" style="text-align: center; background-color: #152F4A; color: white !important;">{{strtoupper($clasificacion->nombre)}}</th>
                </tr>       
               <tr>
                  <th>No.</th>
                  <th>AUTOPSIA MECANISMOS</th>   
                  {{-- <th>MORELIA</th>   
                  <th>USPEC</th>  
                  <th>UECS</th>   --}}
                  @foreach ($fiscalias->sortBy('nombre') as $fiscalia)
                     {{-- @continue($fiscalia->id == 4) --}}
                     <th>{{$fiscalia->nombre}}</th>
                  @endforeach
                  <th>TOTAL</th>
               </tr>
            </thead>
            <tbody>
               @foreach ($necropsias->where('necropsia_clasificacion_id',$clasificacion->id)->sortBy('nombre')->values() as $i => $necropsia)
                  <tr>
                     <td>{{$i +1}}</td>
                     <td>{{$necropsia->nombre}}</td>
                     @foreach ($fiscalias->sortBy('nombre') as $fiscalia)
                         <td>{{$necro_peticiones->where('necropsia_id',$necropsia->id)->where('fiscalia2_id',$fiscalia->id)->where('unidad3_id',null)->count()}}</td>
                     @endforeach
                     <td>{{$necro_peticiones->where('necropsia_id',$necropsia->id)->where('unidad3_id',null)->count()}}</td>
                  </tr>                   
               @endforeach
            </tbody>
         </table>
      @endforeach

       {{-- @php $n = 1; @endphp
       @foreach ($necropsias as $necropsia)
         <tr>
           <td colspan="{{$fiscalias->count() +5 }}" style="text-align: center; background-color: #152F4A; color: white !important;">{{strtoupper($necropsia->necropsia_tipo)}}</td>
         </tr>
          
          @foreach ($necros->where('necropsia_tipo',$necropsia_tipo)->sortBy('nombre') as $necro)
             <tr>
                <td>{{$n++}}</td>
                <td>{{$necro->nombre}}</td>
                <td>{{$necropsias->where('fiscalia2_id',4)->where('unidad_id',2)->where('necropsia_id',$necro->id)->count()}}</td>
                <td>{{$necropsias->where('fiscalia2_id',4)->where('unidad_id',6)->where('necropsia_id',$necro->id)->count()}}</td>
                <td>{{$necropsias->where('fiscalia2_id',4)->where('unidad_id',7)->where('necropsia_id',$necro->id)->count()}}</td>
                @foreach ($fiscalias->sortBy('nombre') as $fiscalia)
                   @continue($fiscalia->id == 4)
                   <td>{{$necropsias->where('fiscalia2_id',$fiscalia->id)->where('necropsia_id',$necro->id)->count()}}</td>
                @endforeach
                <td>{{$necropsias->where('necropsia_id',$necro->id)->count()}}</td>
             </tr>
           @endforeach
      
       
          @endforeach
       

          <tr style="background-color: #c09f77; color:white !important;">
            <td>{{$n++}}</td>
            <td>TOTAL</td>
            
            <td>{{$necropsias->where('fiscalia2_id',4)->where('unidad_id',2)->count()}}</td>
            <td>{{$necropsias->where('fiscalia2_id',4)->where('unidad_id',6)->count()}}</td>
            <td>{{$necropsias->where('fiscalia2_id',4)->where('unidad_id',7)->count()}}</td>
            @foreach ($fiscalias->sortBy('nombre') as $fiscalia)
               @continue($fiscalia->id == 4)
                 <td>{{$necropsias->where('fiscalia2_id',$fiscalia->id)->count()}}</td>
           @endforeach
               <td>{{$necropsias->count()}}</td>
            
          </tr> --}}
       
          
       
       
     {{-- </tbody>   
   </table> --}}