@extends('layouts.front')
@section('content')
  <div class="container-fluid header-top">
    <h1 class="h1 mb-1">Ofertas exclusivas</h1>
    <h2 class="h2 mb-0 font-weight-normal">Encuentra los mejores productos a un precio increíble.</h2>
  </div>

  @include('front.includes.bannertop', ['banners' => $data['banners']->where('tipo','T')])

  <div class="container-fluid no-padding inicio-cuadros">
    <div class="container">
      <div class="row">
        <template v-for="item in list" v-if="paging.total > 0">
          <div class="col-lg mr-2 cont-microsoft cont-microsoft-01">
            <img :src="item.imagen_url" class="mx-auto img-fluid w-100 d-block" alt="Target-01">
            <div class="cont-tablet">
              <h3>(% item.titulo %)</h3>
              <p v-html="item.descripcion"></p>
              <a :href="item.link" target="_blank" class="btn btn-microsoft btn-microsoft-01" tabindex="-1" role="button">LO QUIERO</a>
            </div>
          </div>        
        </template>
      </div>

      <nav aria-label="Page navigation example">
        <paginate 
          :prev-text="'Ant'"
          :next-text="'Sig'"
          v-model="paging.current_page" 
          :page-count="paging.last_page" 
          :container-class="'pagination pagination-sm justify-content-center'" 
          :page-class="'page-item'"
          :prev-class="'page-item'"
          :next-class="'page-item'"
          :page-link-class="'page-link'"
          :prev-link-class="'page-link'"
          :next-link-class="'page-link'"
          :click-handler="onChangePage" 
          v-show="paging.total > 0">
        </paginate>
      </nav>      
    
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
    _components['paginate'] = VuejsPaginate;   

    this._mounted.push(function(_this) {
        _this.filter();
    });

    var ofertasPage = true;
	</script>
@endsection
@section('css')
    <link href="{{asset('css/entrenamiento.css')}}" rel="stylesheet">
    <link href="{{asset('css/ofertas-exclusivas.css')}}" rel="stylesheet">
@endsection