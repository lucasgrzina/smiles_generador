@extends('layouts.app')

@section('css')
    @parent
    <link rel="stylesheet" href="{{ asset('admin/crud/css/cu.css') }}"/>
    <link rel="stylesheet" href="{{ asset('admin/crud/css/smiles.css') }}"/>
    <style>
        .label-info-form {
            padding: 5px 5px;
            text-transform: uppercase;
            display: block;
        }
    </style>

    <style type="text/css">
    .box-add-slot{
        justify-content: center;
        display: flex;
        margin: 10px 0;
        border-width: 0 0 5px;
        border-color: #c4c4c4;
        border-style: solid;
        padding-bottom: 10px;
        gap:10px;
    }
    .flex-items{
        display: flex !important;
        justify-content: space-around;
        width: 100%;
        gap: 15px;
        align-items: center;
    }

    .flex-items input{
        border-width: 0 0 1px;
        text-align:left;
        font-size: 18px;
        font-weight: 700;
    }
    .row-content{
        display: grid;
        grid-template-columns: 76px auto 273px;
        margin: 0 auto;
        /* max-width: calc(100% - 50px); */
        padding: 8px 10px;
        background: #f579210a;
        border-width: 0 0 1px;
        border-style: solid;
        border-color: #f4f4f4;
    }

    .row-content.head{
        font-weight: bold;
        background: #f1f1f1;
    }

    .multi-collapse{}
    .multi-collapse .card-body{
        padding: 18px 15px 4px;
    }
    
</style>
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
        console.debug(_data.selectedItem);
        _data.nuevoGrupo = {
            nombre: null,
            tipo: 'C',
            id: 0
        };



        _data.files = {
            imagen_web: [],
            imagen_mobile: []
        };

        _data.saving = false;


        _methods.openModalGrupos = function(){
            var _this = this;
            if(_data.info.open_modal_grupos){
                $('#modal-grupos').modal('show');
            }
            
        }

        

         _methods.uploadImageCustom = function (item, event, url_upload, token, pos){
            //console.log(event.target.files);
            var _this = this;

            var formData = new FormData();
            var imagefile = event.target.files[0];
            formData.append("file", imagefile);
            formData.append("_token", token);
            formData.append("folder",'slot_mail_' + _this.selectedItem.id);

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
           
            var _ajaxMethod = _this.selectedItem.id == 0 ? _this.ajaxPost : _this.ajaxPut ;
            var _is_valid = _this.validateForm();
            _this.alert.show = false;



            return _this.$validator.validateAll().then(function(result) {
                     
                if (result && _is_valid) {
                    var legales = JSON.parse(JSON.parse(_this.selectedItem.legales));
                    console.debug(legales);
                    if (!legales.legales) {
                        alert('Debes seleccionar un contenido predefinido para los legales');
                        return false;
                    }                    
                    _this.saving = true;
                    return _ajaxMethod(_this.url_save,_this.selectedItem,true,_this.errors).then(function(data){
                        
                        _this.saving = false;
                        
                        if(redirect){
                           location.href = _this.url_index; 
                        }else if(_this.selectedItem.id == 0){
                            location.href = _this.url_index+'/'+data.id+'/edit';
                        }
                        
                    }, function(error) {
                        _this.saving = false;
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
       
        _methods.editContenido = function(item) {
            var _this = this;
            let editURL = _this.url_contenido_edit.replace('_ID_',item.id).replace('_GRUPOID_',item.slot_mail_group_id);
            window.location.href = editURL;
       }  

        _methods.selectLegales = function(evt, $tipo) {
            var _this = this;
            if($tipo == 'predefinido'){
                _data.id_legales = evt.target.value;
            }

            if($tipo == 'legales_custom'){
                _data.legales_custom = evt;
            }

            let $legales = {legales: _data.id_legales, legales_custom: _data.legales_custom};
            _data.legales  = JSON.stringify($legales);
            _data.selectedItem.legales = JSON.stringify(_data.legales);
            
            
        }

        _methods.destroyContenido = function(item, index) {
            var _this = this;


            if (confirm('Deséa eliminar la pieza seleccionada?')) {
                _this.alert.show = false;
                _this.loading = true;
                return _this.ajaxDelete(_this.url_contenido_delete.replace('_ID_',item.id),item,true,_this.errors).then(function(data){
                    _this.selectedItem.contenidos.splice(index, 1);
                }, function (error) {
                    _this.loading = false;
                });
            }


            
           
       }        
       
       _methods.deleteGrupo = function(idGrupo, url_delete) {
            var _this = this;
            
            var _ajaxMethod = _this.ajaxPost ;
            _this.saving = true;
                return _ajaxMethod(url_delete).then(function(data){
                    
                    _this.saving = false;
                    
                    document.location.reload()
                    
                }, function(error) {
                    _this.saving = false;
            });    
       }

       _methods.storeGrupo = function() {
            var _this = this;
           
           var _ajaxMethod = _this.nuevoGrupo.id == 0 ? _this.ajaxPost : _this.ajaxPut ;
           var _is_valid = true;
           _this.alert.show = false;



           return _this.$validator.validateAll().then(function(result) {
                    
               if (result && _is_valid) {
                   if (!_this.nuevoGrupo.nombre) {
                       alert('Debes ingresar un nombre para el grupo');
                       return false;
                   }                    
                   _this.saving = true;
                   return _ajaxMethod(_this.url_save_grupo,_this.nuevoGrupo,true,_this.errors).then(function(data){
                       
                       _this.saving = false;
                       
                       document.location = data.url_redirect;
                       
                   }, function(error) {
                       _this.saving = false;
                   });                            
               }

           });

       }
       _methods.cambiarValorGrupo = function(item,campo) {
            var _this = this; 
            var data = {campo: campo, valor: item[campo]};
            console.debug(data);
            if (item.id && item.id > 0) {
                _this.ajaxPut(_this.url_cambiar_valor_grupo.replace('_ID_',item.id),data,true,_this.errors).then(function(data){
                    _this.saving = false;
                }, function(error) {
                    _this.saving = false;
                }); 

            }
       }

       window.addEventListener('load', function() {
       
        _methods.openModalGrupos();
        });
       
      
    </script>
    <script type="text/javascript" src="{{ asset('vendor/vee-validate.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/crud/js/cu.js') }}"></script>

    
@endsection

@section('content-header')
    {!! AdminHelper::contentHeader('Piezas (Slots)',isset($data['selectedItem']->id) && $data['selectedItem']->id > 0 ? trans('admin.edit') : trans('admin.add_new'),false) !!}
@endsection

@section('content')
    @include('admin.components.switches')
    <div class="content">

        @include('admin.slot_mails.fields')



        <div class="box ">
            <div class="box-footer text-right">
                <button-type type="save" :promise="store" v-if="selectedItem.id > 0"></button-type>
                <button type="save" @click="store(false)" class="btn btn-sm bg-green btn-save">
                    <i class="fa fa-save" v-if="!saving"></i><i class="fa fa-spinner fa-spin fa-save" v-if="saving"></i> Guardar y continuar</button>
                <button-type type="cancel" @click="cancel()"></button-type>
            </div>   
        </div>   
    </div>
@endsection

