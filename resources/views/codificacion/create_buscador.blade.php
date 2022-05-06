{{-- @component('componentes.componente_sidenav_buscador') --}}
    <div class="row">
        <form action="" class="col s12">
            <div class="row">
                <div class="input-field col s12 l4 offset-l7">
                    <input type="text" id="ci-pp" name="ci_pp" value="{{old('ci_pp')}}">
                    <label for="ci-pp">CI-PP</label>
                </div>
                <div class="input-field col s12 l1">
                    <button class="btn-guardar" id="btn-buscar" style="display: inline-block !important; width:100%;" type="submit" name="btn" value="buscar">Buscar</button>
                 </div>
            </div>
            {{-- <section class="nuc-section">
             
                <div class="row" style="">
                   <div class="col s12">
                      <a href="" id="add-nuc" class="i-btn"><i class="fa fa-plus-circle fa-lg"></i><span> <b>- AGREGAR CAMPO</b> </span></a>
                   </div>
                </div>
                <div id="div-row-nucs" class="row">
                   <div class="input-field col s3">
                      <a href="" class="nuc-x"><i class="fas fa-times i-x"></i></a>
                      <input form="form-codificacion-busqueda" id="nuc" type="text" placeholder="N.U.C." class="validate" name="nucs[]">
                   </div>
                </div>
             </section> --}}
       
          {{-- <div class="row">
             
             
             <div class="col s12">
                <hr class="hr-main">
             </div>
       
             <div class="input-field col s12">
                <button form="form-codificacion-busqueda" class="btn-guardar" id="btn-buscar" style="display: inline-block !important; width:100%;" type="submit" name="btn" value="buscar">Buscar...</button>
             </div>
          </div> --}}
        </form>
    </div>
{{-- @endcomponent --}}