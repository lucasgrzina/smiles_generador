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
    </script>
@endsection

@section('content-header')
{!! AdminHelper::contentHeader('Custom Mails', 'Ver') !!}
@endsection

@section('content')
    <div class="content">
        
        <!-- templates -->

        <!-- end templates -->
        <div class="box box-default box-show">
            <div class="box-body no-padding">
                <div id="exporthtml">
                    @include('admin.custom_mails.templates.diario',[
                        'nombre' => $data['selectedItem']->nombre,
                        'publicidad' => $data['selectedItem']->publicidad,
                        'saldo' => $data['selectedItem']->saldo,
                        'contenido' => json_decode($data['selectedItem']->contenido),
                        'footer' => $data['info']->footerhtml,
                        'redes' => $data['info']->redeshtml,
                        'legaleshtml' => $data['info']->legaleshtml,
                        'legales_custom' => $data['info']->legales_custom,
                    ])
                    </div>
            </div>
            <div class="box-footer text-right">
                @if(auth()->user()->hasRole('Superadmin') || auth()->user()->can('editar-'.$data['action_perms']))
                    <button-type type="edit" @click="edit(selectedItem)"></button-type>
                @endif
                <button-type type="back" @click="goTo(url_index)"></button-type>
                <button class="btn btn-sm bg-purple btn-back" @click="goTo(url_export)">
                    Exportar HTML
                </button>
            </div>        
        </div>

    </div>    
@endsection