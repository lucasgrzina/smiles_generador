@extends('layouts.app')

@section('css')
    @parent
    <link rel="stylesheet" href="{{ asset('admin/crud/css/show.css') }}"/>
@endsection

@section('scripts')
    @parent
    <script type="text/javascript" src="{{ asset('admin/crud/js/show.js') }}"></script>
    <script type="text/javascript">
        var _data = {!! json_encode($data) !!};
        _methods.nombreTipo = function(codigo) {
            var templates = this.info.tipos;
            if (typeof templates[codigo] !== 'undefined') {
                return templates[codigo];
            }
            return codigo;
        };        
    </script>
@endsection

@section('content-header')
{!! AdminHelper::contentHeader('Contenido Predefinido', 'Ver') !!}
@endsection

@section('content')
    <div class="content">
        <div class="box box-default box-show">
            <div class="box-body no-padding">
                <div class="table-responsive">
                        <table class="table table-view-info  table-condensed">
                            <tbody>
                                @include('admin.contenido_predefinidos.show_fields')
                            </tbody>
                        </table>
                </div>                
            </div>
            <div class="box-footer text-right">
                @if(auth()->user()->hasRole('Superadmin') || auth()->user()->can('editar-'.$data['action_perms']))
                    <button-type type="edit" @click="edit(selectedItem)"></button-type>
                @endif
                <button-type type="back" @click="goTo(url_index)"></button-type>
            </div>        
        </div>
    </div>    
@endsection