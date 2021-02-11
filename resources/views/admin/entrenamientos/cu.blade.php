@extends('layouts.app')

@section('css')
    @parent
    <link rel="stylesheet" href="{{ asset('admin/crud/css/cu.css') }}"/>
@endsection

@section('scripts')
    @parent
    <script type="text/javascript" src="{{ asset('vendor/vue-upload-component/vue-upload-component.min.js') }}"></script>
    <script type="text/javascript">
        Vue.component('file-upload', VueUploadComponent);
        var _data = {!! json_encode($data) !!};

        _data.files = {
            archivo: [],
            imagen: []
        }

        _methods.inputArchivo = function (n,o) {
          var _this = this;
          this.inputFile(n,o,function(file) {
              //_this.errors.remove('files');
              _this.selectedItem.archivo_url = file.response.data.path;
              _this.selectedItem.archivo = file.response.data.file;          
          }, function(file) {
            //_this.errors.add('light_logo',file.error, 'server');
          },'uploadArchivo');
        } 

        _methods.inputImagen = function (n,o) {
          var _this = this;
          this.inputFile(n,o,function(file) {
              //_this.errors.remove('files');
              _this.selectedItem.imagen_url     = file.response.data.path;      
              _this.selectedItem.imagen         = file.response.data.file;   
          }, function(file) {
            //_this.errors.add('light_logo',file.error, 'server');
          },'uploadImagen');
        } 

        _methods.removeImagen = function(tipo) {
            this.selectedItem['imagen' + tipo] = null;
            this.selectedItem['imagen' + tipo + '_url'] = null;
        }
    </script>
    <script type="text/javascript" src="{{ asset('vendor/vee-validate.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/crud/js/cu.js') }}"></script>

 
@endsection

@section('content-header')
    {!! AdminHelper::contentHeader('Entrenamientos',isset($data['selectedItem']->id) && $data['selectedItem']->id > 0 ? trans('admin.edit') : trans('admin.add_new'),false) !!}
@endsection

@section('content')
    @include('admin.components.switches')
    <div class="content">
        <div class="box box-default box-cu">
            <div class="box-body">
                <div class="row">
                        @include('admin.entrenamientos.fields')
                </div>
            </div>
            <div class="box-footer text-right">
                <button-type type="save" :promise="store"></button-type>
                <button-type type="cancel" @click="cancel()"></button-type>
            </div>            
        </div>    
    </div>
@endsection