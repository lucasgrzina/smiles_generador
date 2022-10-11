@extends('layouts.app')

@section('css')
    @parent
    <link rel="stylesheet" href="{{ asset('admin/crud/css/index.css') }}"/>
    <style type="text/css">
    .row-content{
        display: grid;
        grid-template-columns: 76px auto 273px;
        margin: 0 auto;
        /* max-width: calc(100% - 50px); */
        padding: 8px 10px;
        background: #f579210a;
        border-width: 0 0 1px;
        border-style: solid;
        border-color: #f4f4f4;
    }

    .row-content.head{
        font-weight: bold;
        background: #f1f1f1;
    }

    .multi-collapse{}
    .multi-collapse .card-body{
        padding: 10px 0;
    }
    
</style>
    
@endsection

@section('scripts')
    @parent
    <script src="//cdnjs.cloudflare.com/ajax/libs/Vue.Draggable/2.20.0/vuedraggable.umd.min.js"></script>
    <script type="text/javascript">
        Vue.component('draggable', vuedraggable);
        var _data = {!! json_encode($data) !!};
        _data.info = {
            templates: {!! json_encode(config('constantes.templates',[])) !!}
        };

        _methods.create = function(template) {
            this.storeFilters();

            document.location = this.url_create.concat('?template=').concat(template);
        };

        _methods.nombreTemplate = function(codigo) {
            var templates = this.info.templates;
            if (typeof templates[codigo] !== 'undefined') {
                return templates[codigo];
            }
            return codigo;
        };

        _methods.clonar = function(item) {
            var _this = this;
            if (confirm('Deséa clonar la pieza seleccionada?')) {
                _this.alert.show = false;
                _this.loading = true;
                return _this.ajaxPut(_this.url_clonar.replace('_ID_',item.id),item,true,_this.errors).then(function(data){
                    _this.doFilter();
                }, function (error) {
                    _this.loading = false;
                });
            }
            
        };
        
       _methods.editContenido = function(item) {
            var _this = this;
            let editURL = _this.url_contenido_edit.replace('_ID_',item.id);
            window.location.href = editURL;
       }

       _methods.createContenido = function(item) {
            var _this = this;
            let createURL = _this.url_contenido_create.replace('_ID_',item.id);
            window.location.href = createURL;
       }

       _methods.clonarContenido = function(item){
            var _this = this;
            if (confirm('Deséa clonar la pieza seleccionada?')) {
                _this.alert.show = false;
                _this.loading = true;
                return _this.ajaxPut(_this.url_contenido_clonar.replace('_ID_',item.id),item,true,_this.errors).then(function(data){
                    _this.doFilter();
                }, function (error) {
                    _this.loading = false;
                });
            }
       }

       _methods.destroyContenido = function(item) {
            var _this = this;


            if (confirm('Deséa eliminar la pieza seleccionada?')) {
                _this.alert.show = false;
                _this.loading = true;
                return _this.ajaxDelete(_this.url_contenido_delete.replace('_ID_',item.id),item,true,_this.errors).then(function(data){
                    _this.doFilter();
                }, function (error) {
                    _this.loading = false;
                });
            }


            
           
       }

       
                        

        this._mounted.push(function(_this) {
            _this.doFilter();
        });
    </script>
    
    <script type="text/javascript" src="{{ asset('vendor/vuejs-paginate/vuejs-paginate.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/crud/js/index.js') }}"></script>
@endsection

@section('content-header')
 <section class="content-header">
            <h1>
            Piezas (Slots)
            </h1>

            
            <small>Listado</small>
            @if(auth()->user()->hasRole('Superadmin') || auth()->user()->can('editar-'.$data['action_perms']))
            <div class="pull-right dropdown">
              <button class="btn bg-green btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
                <i class="fa fa-plus"></i> Nuevo 
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu">
                @foreach (config('constantes.templates',[]) as $codigo => $nombre)
                    <li><a v-on:click="create('{{$codigo}}')">{{$nombre}}</a></li>     
                @endforeach
              </ul>
            </div>
            @endif
        </section>
@endsection

@section('content')
    @include('admin.components.switches')
    <div class="content">
        <div class="box box-default box-page-list">
            <div class="box-body box-filter">
                <div class="form-inline">
                    @include('admin.includes.crud.index-filters-input')
                    <div class="form-group">
                        <select v-model="filters.template" class="form-control input-sm" name="template">
                            <option :value="null">Templates (todos)</option>
                            <option v-for="(item,index) in info.templates" :value="index">(% item %)</option>
                        </select>
                    </div>                    
                    <!-- cualquier otro campo -->
                    @include('admin.includes.crud.index-filters-btn')
                </div>
            </div>
            <div class="box-body box-list no-padding">
                    @include('admin.slot_mails.table')
            </div>
            <div class="box-footer">
                <div class="col-sm-8 left">
                    <span v-if="!loading">(% paging.total %) registro(s)</span>
                </div>
                <div class="col-sm-4 right">
                    @include('admin.includes.crud.index-pagination')
                </div>
            </div>
            @include('admin.includes.crud.index-loading')            
        </div>
    </div>


@endsection

