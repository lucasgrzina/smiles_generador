@extends('layouts.front')
@section('content')
    
        <div class="container-fluid header-top">
          <h1 class="h1 mb-1">Entrenamiento</h1>
          <h2 class="h2 mb-0 font-weight-normal">Aprende. Obtén habilidades. Sube de nivel.</h2>
        </div>

        @include('front.includes.bannertop', ['banners' => $data['banners']->where('tipo','T')])

        <div class="container-fluid video-contenido">
          
            {!! $data['entrenamiento']->video !!}
      
          <h2 class="h2 mt-3 mb-1 font-weight-bold mx-auto">{{$data['entrenamiento']->titulo}}</h2>
          <p class="p mb-1 mx-auto">{{$data['entrenamiento']->descripcion}}</p>
        </div>

        <div class="container-fluid no-padding inicio-cuadros">
          <div class="container">
            <div class="row">
              <template v-for="item in relacionados" >
                <div class="col-lg mr-2 cont-microsoft cont-microsoft-01">
                  <img :src="item.imagen_url" class="mx-auto img-fluid w-100 d-block" :alt="item.titulo">
                  <div class="cont-tablet">
                    <h4>(% item.tipo %)</h4>
                    <h3>(% item.titulo %)</h3>
                    <p v-html="item.descripcion"></p>
                    <a v-if="item.tipo === 'V'" :href="linkDetalleEntrenamiento(item)" class="btn btn-microsoft btn-microsoft-01" tabindex="-1" role="button">VER MÁS</a>
                    <a v-else :href="linkDetalleEntrenamiento(item)" class="btn btn-microsoft btn-microsoft-01" tabindex="-1" role="button" download>DESCARGAR</a>
                  </div>
                </div>
              </template>
            </div>
          </div>
        </div>

        @include('front.includes.bannerbottom', ['banners' => $data['banners']->where('tipo','B')])
@endsection

@section('scripts')
  @parent
  <script type="text/javascript" src="{{ asset('vendor/vuejs-paginate/vuejs-paginate.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/listados.js') }}"></script>
  <script type="text/javascript">
    var _data = {!! json_encode($data) !!};
    
  
   

    _methods.linkDetalleEntrenamiento = function(item) {
      var _this = this;
      var _urlBase = "{{url('uploads/entrenamientos')}}";
      if (item.tipo === 'V') {
        return _this.url_detalle.replace('_ID_',item.id);
      } else {
        return _urlBase+'/'+item.archivo;
      }
    }

    

  </script>
@endsection
@section('css')
 <!-- Custom styles for this template -->
    <link href="{{url('css/entrenamiento.css')}}" rel="stylesheet">
    <link href="{{url('css/color-entrenamiento.css')}}" rel="stylesheet">
@endsection