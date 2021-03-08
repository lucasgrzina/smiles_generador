@extends('layouts.app')

@section('css')
    @parent
    <link rel="stylesheet" href="{{ asset('admin/crud/css/index.css') }}"/>
    
    
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
            Piezas
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
                    @include('admin.custom_mails.table')
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

