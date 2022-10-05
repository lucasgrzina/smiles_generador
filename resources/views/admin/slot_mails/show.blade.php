@extends('layouts.app')

@section('css')
    @parent
    <link rel="stylesheet" href="{{ asset('admin/crud/css/show.css') }}"/>

    <style type="text/css">
        .content-buttons{
            display: flex;
                    gap: 10px;
                    justify-content: center;
                    padding: 10px;
                    background: #fff;
                    border-width: 0 0 1px;
                    border-style: solid;
                    border-color: #ff5a00;
        }
    </style>
@endsection

@section('scripts')
    @parent
    <script type="text/javascript" src="{{ asset('admin/crud/js/show.js') }}"></script>
    <script type="text/javascript">
        var _data = {!! json_encode($data) !!};

        _data.piezaView = {{$data['selectedItem']->contenidos[0]->id}};

        _methods.verPieza = function(itemID) {
            var _this = this;
            _this._data.piezaView = itemID;
       }
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
                <div class="content-buttons" v-if="{{count($data['selectedItem']->contenidos)}} > 1">
                  
                    <div class="pull-right dropdown">
                        <button type="button" data-toggle="dropdown" class="btn bg-green dropdown-toggle">
                            <i class="fa fa-eye"></i> Ver Pieza
                            <span class="caret"></span>
                        </button> 
                        <ul class="dropdown-menu">
                            @foreach($data['selectedItem']->contenidos as $contenido)
                            <li><a @click="verPieza('{{$contenido->id}}')">{{$contenido->nombre}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @foreach($data['selectedItem']->contenidos as $contenido)
                <div class="w-100" style="padding: 15px 20px; display: flex; justify-content: center;" v-if="_data.piezaView == {{$contenido->id}}">
                    <div><span style="font-weight: bold; font-size: 18px;">{{$contenido->nombre}} </span></div>
                </div>
                @endforeach
                <div id="exporthtml">
                   
                        

                        @foreach($data['selectedItem']->contenidos as $contenido)
                            <div class="exporthtml" v-if="_data.piezaView == {{$contenido->id}}">
                                
                            @include('admin.slot_mails.templates.'.$data['selectedItem']->template,[
                                'nombre' => $contenido->nombre,
                                'publicidad' => $data['selectedItem']->publicidad,
                                'saldo' => $data['selectedItem']->saldo,
                                'contenido' => json_decode($contenido['contenido']),
                                'footer' => $data['info']->footerhtml,
                                'redes' => $data['info']->redeshtml,
                                'legaleshtml' => $contenido['legaleshtml'],
                                'legales_custom' => $contenido['legales_custom']
                            ])
                            </div>
                        @endforeach
                   
                </div>
            </div>
            <div class="box-footer text-right">
                @if(auth()->user()->hasRole('Superadmin') || auth()->user()->can('editar-'.$data['action_perms']))
                    <button-type type="edit" @click="edit(selectedItem)"></button-type>
                @endif
                <button-type type="back" @click="goTo(url_index)"></button-type>
                <button class="btn btn-sm bg-purple btn-back" @click="goTo(url_export+'/'+_data.piezaView)">
                    Exportar HTML
                </button>
            </div>        
        </div>

    </div>    
@endsection