@extends('layouts.app')

@section('css')
    @parent
    <link rel="stylesheet" href="{{ asset('admin/crud/css/cu.css') }}"/>
    <link rel="stylesheet" href="{{ asset('admin/crud/css/smiles.css') }}"/>
@endsection

@section('scripts')
    @parent
    <script type="text/javascript" src="{{ asset('public/vendor/tinymce/js/tinymce/tinymce.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/vendor/tinymce/js/tinymce/vue-mce.web.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/vue-upload-component/vue-upload-component.min.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sortablejs@1.8.4/Sortable.min.js"></script>
    <!-- CDNJS :: Vue.Draggable (https://cdnjs.com/) -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/Vue.Draggable/2.20.0/vuedraggable.umd.min.js"></script>
 

    <script type="text/javascript">
        Vue.component('file-upload', VueUploadComponent);
        Vue.component('draggable', vuedraggable);
        Vue.component('Sortable', Sortable);

        var _data = {!! json_encode($data) !!};
        _data.files = {
            imagen_web: [],
            imagen_mobile: []
        };

         _methods.uploadImageCustom = function (item, event, url_upload, token, model){
            //console.log(event.target.files);
            var _this = this;

            var formData = new FormData();
            var imagefile = event.target.files[0];
            formData.append("file", imagefile);
            formData.append("_token", token);

            $.ajax({
                url: url_upload,
                type: "post",   
                data: formData,
                cache: false,
                contentType: false,
                processData: false
            }).done(function(res){
                item.input = res.data.path;
               _this.exportar();
            });
        };

        _methods.inputImagen = function (n,o) {
          var _this = this;
         
        
          this.inputFile(n,o,function(file) {

              //_this.errors.remove('files');
             
              //_this.selectedItem.fileurl = file.response.data.path;
              //_this.selectedItem.filevalue = file.response.data.file;          
          }, function(file) {
            //_this.errors.add('light_logo',file.error, 'server');
          },'uploadImagenMail');
        }
        
    </script>
    <script type="text/javascript" src="{{ asset('vendor/vee-validate.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/crud/js/cu.js') }}"></script>

    
@endsection

@section('content-header')
    {!! AdminHelper::contentHeader('Custom Mails',isset($data['selectedItem']->id) && $data['selectedItem']->id > 0 ? trans('admin.edit') : trans('admin.add_new'),false) !!}
@endsection

@section('content')
    @include('admin.components.switches')
    <div class="content">
        <div class="box box-default box-cu">
            <div class="box-body">
                <div class="row">
                        @include('admin.custom_mails.fields')
                </div>
            </div>
            <div class="box-footer text-right">
                <button-type type="save" :promise="store"></button-type>
          
                <button-type type="cancel" @click="cancel()"></button-type>
            </div>   
        </div>   
    </div>
@endsection