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
        .exporthtml a {
            text-decoration: underline;
        }

        .list-group-pieza{
            
        }

        .list-group-pieza .list-group-item{
            padding: 0 10px 10px;
        }

        .list-group-pieza h4{
            font-size: 16px;
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 7px;
            border-width: 0 0 1px;
            border-style: solid;
            padding: 5px 0 5px;
            border-color: #c4c4c4;
        }

        .btn-group-vertical{
            width: 100%;
        }
        .list-group-pieza .list-group-item .btn-secondary{
            width: 100%;
            text-align: left;
            box-shadow: none;
            border-width: 1px 1px 0;
            border-style: solid;
            border-color: #c4c4c4; 
            text-wrap: nowrap;
            text-overflow: ellipsis;
            width: 100%;
            overflow: hidden;
        }

        .list-group-pieza .list-group-item .btn-secondary:last-child{
            border-width: 1px 1px 1px;
        }

        .list-group-pieza .list-group-item .btn-secondary.active,
        .list-group-pieza .list-group-item .btn-secondary:focus{
            background-color: #767676 !important;
            box-shadow:none;
            outline: none;
            color:#fff !important;
        }

        .list-group-pieza .list-group-item .btn-secondary:hover{
            background-color: #e0e0e0;
        }
    </style>
@endsection

@section('scripts')
    @parent
    <script type="text/javascript" src="{{ asset('admin/crud/js/show.js') }}"></script>
    <script type="text/javascript">
        var _data = {!! json_encode($data) !!};
        _data.setInitActive = false;
        _data.piezaView = {{$data['selectedItem']->contenidos[0]->id}};

        _methods.verPieza = function(itemID) {
            var _this = this;
            _this._data.piezaView = itemID;
       }

       _methods.setActive = function (contenidoActive, grupo) {
            _data.selectedItem.contenidos.forEach(contenidoItem => {
                if(grupo.id == contenidoItem.slot_mail_group_id){
                    if(contenidoActive.id == contenidoItem.id){
                        contenidoItem.activo = true;                       
                    }else{
                        contenidoItem.activo = false;
                    }
                }   
            });
       }

       _methods.initTemplate = function (){
            alert('initTemplate');
       }

       _methods.parseContenido = function(contenidoJson){
            let _this = this;
            
            var contenido = JSON.parse(contenidoJson);
            return contenido;
        }

        _methods.ordenarContenidosGrupos = function(contenidos){
            const sortedArray = contenidos.slice();

            // Ordenamos el arreglo por la propiedad slot_mail_group_id
            sortedArray.sort((a, b) => a.slot_mail_group_id - b.slot_mail_group_id);
            if (!_data.setInitActive){
                const uniqueIds = new Set();

                sortedArray.forEach((item) => {
                    if (!uniqueIds.has(item.slot_mail_group_id)) {
                        item.activo = true;
                        uniqueIds.add(item.slot_mail_group_id);
                    } else {
                        item.activo = false;
                    }
                });
                _data.setInitActive = true;
            }
            

            return sortedArray;
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
                <div class="row">
                    <div class="col-md-3"> 
                                        
                        <ul class="list-group list-group-pieza" v-if="_data.selectedItem.grupos.length > 0">
                            <li class="list-group-item" v-for="grupo in _data.selectedItem.grupos">
                                <h4>(% grupo.nombre %)</h4>
                                <div class="btn-group-vertical btn-group-toggle" data-toggle="buttons">
                                    <label @click="setActive(contenido, grupo)" :class="['btn', 'btn-secondary', contenido.activo ? 'active' : '']" v-if="contenido.slot_mail_group_id == grupo.id" v-for="contenido in _data.selectedItem.contenidos">
                                        <input type="radio"  :name="'radio_'+grupo.id" :id="'option'+contenido.id" > (% contenido.nombre %)  
                                    </label>
                                </div>
                            </li>
                        </ul>
                        
                    </div>

                    <div class="col-md-9">
                        <div id="exporthtml">
                            @foreach($data['selectedItem']->contenidos as $contenido)
                                <div class="exporthtml" v-if="_data.piezaView == {{$contenido->id}}">
                                    
                                @include('admin.slot_mails.templates.pieza_madre',[
                                    'export' => false,
                                    'nombre' => $contenido->nombre,
                                    'publicidad' => $data['selectedItem']->publicidad,
                                    'saldo' => $data['selectedItem']->saldo,
                                    'contenido' => json_decode($contenido['contenido']),
                                    'footer' => $data['info']->footerhtml,
                                    'redes' => $data['info']->redeshtml,
                                    'legaleshtml' => $contenido['legaleshtml'],
                                    'legales_custom' => $contenido['legales_custom'],
                                    'tarj_susp' => $data['selectedItem']->tarjetaSusp ? $data['selectedItem']->tarjetaSusp->contenido : false
                                ])
                                </div>
                            @endforeach
                
                        </div>
                    </div>
                </div>
                
                
            </div>
            <div class="box-footer text-right">
                @if(auth()->user()->hasRole('Superadmin') || auth()->user()->can('editar-'.$data['action_perms']))
                    <button-type type="edit" @click="edit(selectedItem)"></button-type>
                @endif
                <button-type type="back" @click="goTo(url_index)"></button-type>
                <div class="pull-right m-l-5 dropdown">
                    <button class="btn bg-green btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
                        Exportar 
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a v-on:click="goTo(url_export+'/madre')">Pieza Madre</a></li>     
                        <li><a v-on:click="goTo(url_export+'/contenido')">Contenido/Legales</a></li>     
                        <li><a v-on:click="goTo(url_export+'/todo')">Todo</a></li>     
                    </ul>
                </div>                
           </div>        
        </div>

    </div>    
@endsection