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

        _methods.nombreTipo = function(codigo) {
            var templates = this.info.tipos;
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
    @if(auth()->user()->hasRole('Superadmin') || auth()->user()->can('editar-'.$data['action_perms']))
        {!! AdminHelper::contentHeader('Contenido Predefinidos',trans('admin.list'),'new','create()') !!}
    @else
        {!! AdminHelper::contentHeader('Contenido Predefinidos',trans('admin.list')) !!}
    @endif
@endsection

@section('content')
    @include('admin.components.switches')
    <div class="content">
        <div class="box box-default box-page-list">
            <div class="box-body box-filter">
                <div class="form-inline">
                    @include('admin.includes.crud.index-filters-input')
                    <!-- cualquier otro campo -->
                    <div class="form-group">
                        <select v-model="filters.tipo" class="form-control input-sm" name="tipos">
                            <option :value="null">Tipos (todos)</option>
                            <option v-for="(item,index) in info.tipos" :value="index">(% item %)</option>
                        </select>
                    </div>                    
                    @include('admin.includes.crud.index-filters-btn')
                </div>
            </div>
            <div class="box-body box-list no-padding">
                    @include('admin.contenido_predefinidos.table')
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

