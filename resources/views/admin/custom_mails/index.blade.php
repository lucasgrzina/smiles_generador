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
            <div class="pull-right dropdown">
              <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Seleccioná Piezza
              <span class="caret"></span></button>
              <ul class="dropdown-menu">
                <li><a v-on:click="create()">Diario</a></li>
                <li><a v-on:click="create()">Template 2</a></li>
                <li><a v-on:click="create()">Template 3</a></li>
                <li><a v-on:click="create()">Template 4</a></li>
              </ul>
            </div>
        </section>
@endsection

@section('content')
    @include('admin.components.switches')
    <div class="content">
        <div class="box box-default box-page-list">
            <div class="box-body box-filter">
                <div class="form-inline">
                    @include('admin.includes.crud.index-filters-input')
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

