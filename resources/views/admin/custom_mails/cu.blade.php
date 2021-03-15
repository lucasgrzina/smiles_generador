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

        _data.saving = false;

         _methods.uploadImageCustom = function (item, event, url_upload, token, pos){
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

                
                if(pos == 1){
                    item.input = res.path;
                }else{
                    item.input2 = res.path;
                }

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


        _methods.store = function(redirect = true) {
            var _this = this;
            _this.saving = true;
            var _ajaxMethod = _this.selectedItem.id == 0 ? _this.ajaxPost : _this.ajaxPut ;
            var _is_valid = _this.validateForm();
            _this.alert.show = false;

            return _this.$validator.validateAll().then(function(result) {
                     
                if (result && _is_valid) {
                    
                    return _ajaxMethod(_this.url_save,_this.selectedItem,true,_this.errors).then(function(data){
                        
                        _this.saving = false;
                        
                        if(redirect){
                           location.href = _this.url_index; 
                        }else if(_this.selectedItem.id == 0){
                            location.href = _this.url_index+'/'+data.id+'/edit';
                        }
                        
                    });                            
                }

            });
        };

        _methods.configMce = function (tipo) {
            var config = {};

            switch (tipo) {
                case 'html':
                    config = {
                        theme: 'modern',
                        fontsize_formats: "",
                        plugins: 'code',
                        toolbar1: 'code',
                        media_filter_html: false
                    }
                    break;            
                default:
                    config = {
                            theme: 'modern',
                            fontsize_formats: "8px 10px 12px 14px 16px 18px 20px 22px 24px 26px 39px 34px 38px 42px 48px",
                            plugins: 'searchreplace autolink textcolor link',
                            toolbar1: 'formatselect fontsizeselect | bold italic strikethrough forecolor backcolor link',
                            media_filter_html: false
                        }                    
                    break;
            }

            return config;
        };
       
             
        
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

        @include('admin.custom_mails.fields')



        <div class="box ">
            <div class="box-footer text-right">
                <button-type type="save" :promise="store"></button-type>
                <button type="save" @click="store(false)" class="btn btn-sm bg-green btn-save">
                    <i class="fa fa-save" v-if="!saving"></i><i class="fa fa-spinner fa-spin fa-save" v-if="saving"></i> Guardar y continuar</button>
                <button-type type="cancel" @click="cancel()"></button-type>
            </div>   
        </div>   
    </div>
@endsection