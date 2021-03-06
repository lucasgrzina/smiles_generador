@extends('layouts.front')
@section('content')
    
  	<div class="container-fluid header-top">
      <h1 class="h1 mb-1">Entrenamiento</h1>
      <h2 class="h2 mb-0 font-weight-normal">Aprende. Obtén habilidades. Sube de nivel.</h2>
    </div>
    
    @include('front.includes.bannertop', ['banners' => $data['banners']->where('tipo','T')])
    
    <div class="container-fluid search-001">
          <div class="container mx-auto">
            <div class="form-inline mx-auto">
              <label class="mdb-main-label">Buscar</label>
              <input class="form-control mx-sm-2" type="text" aria-label="Search" v-model="filters.search">
              <button class="btn btn-unique btn-rounded btn-sm my-0" type="button" @click="filter()">IR</button>
            </div>

            <div class="form-group mx-auto">
              <div class="row row-a">
                <div class="col-1 col-a">
                  <label class="control-label align-middle">Filtros</label>
                </div>
                <div class="col col-a">
                  <select id="filtro_orden" class="form-control" name="filtro_orden" v-model="filters.order" @change="onChangeOrder()">
                    <option selected>Ordenar por</option>
                    <option value="orden|asc">Orden (Asc)</option>
                    <option value="orden|desc">Orden (Desc)</option>
                    <option value="created_at|asc">Más nuevo</option>
                    <option value="created_at|desc">Más viejo</option>
                  </select>
                </div>
                <div class="col col-a"> <!-- added div.col-xs-4 -->
                  <select id="filtro_producto" class="form-control" name="filtro_producto" v-model="filters.producto_id" @change="onChangeProducto()">
                    <option :value="null" selected>Producto</option>
                    <option :value="producto.id" v-for="producto in productos">(% producto.nombre %)</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
    </div>

    <div class="container-fluid no-padding inicio-cuadros">
      <div class="container">
        <div class="row">
          <template v-for="item in list" v-if="paging.total > 0">
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

    _methods.linkDetalleEntrenamiento = function(item) {
      var _this = this;
      var _urlBase = "{{url('uploads/entrenamientos')}}";
      if (item.tipo === 'V') {
        return _this.url_detalle.replace('_ID_',item.id);
      } else {
        return _urlBase+'/'+item.archivo;
      }
    }

    this._mounted.push(function(_this) {
        _this.filter();
    });

    var entrenamientoPage = true;

    if (typeof _methods.onChangeProducto === 'undefined') {
      _methods.onChangeProducto = function(page) {
          var _this = this;
          _this.filters.page = 1;
          _this.filters.producto_id = _this.filters.producto_id;
          _this.doFilter();
      };
    }

	</script>
@endsection
@section('css')
    <link href="{{asset('css/entrenamiento.css')}}" rel="stylesheet">
    <link href="{{asset('css/color-entrenamiento.css')}}" rel="stylesheet">
@endsection