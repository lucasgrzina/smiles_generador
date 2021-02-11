<!-- Nombre Field -->
<div class="form-group col-sm-6" :class="{'has-error': errors.has('nombre')}">
    {!! Form::label('nombre', 'Nombre') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control','v-model' => 'selectedItem.nombre']) !!}
    <span class="help-block" v-show="errors.has('nombre')">(% errors.first('nombre') %)</span>
</div>
<div class="form-group col-sm-6" :class="{'has-error': errors.has('codigo')}">
    {!! Form::label('codigo', 'Codigo') !!}
    {!! Form::text('codigo', null, ['class' => 'form-control','v-model' => 'selectedItem.codigo']) !!}
    <span class="help-block" v-show="errors.has('codigo')">(% errors.first('codigo') %)</span>
</div>
<div class="form-group col-sm-6" :class="{'has-error': errors.has('imagen')}">
    {!! Form::label('imagen', 'Imagen (WEB)') !!}
    <div class="thumb-wrap">
        <button-type v-if="selectedItem.imagen_web" type="remove-list" @click="removeImagen('web')"></button-type>
        <file-upload
            
            :multiple="false"
            :headers="_fuHeader"
            ref="uploadImagen"
            extensions="gif,jpg,jpeg,png,webp,svg"
            accept="image/png,image/gif,image/jpeg,image/webp,image/svg"            
            input-id="imagen"
            v-model="files.imagen"
            post-action="{{ route('uploads.store-file') }}"
            @input-file="inputImagen"
            class="thumbnail">
                <img class="img-responsive" src="{{ asset('admin/img/generic-upload.png') }}" v-if="!selectedItem.imagen_url">
                <img class="img-responsive" :src="selectedItem.imagen_url" v-else>
                <div class="progress m-t-5 m-b-0" v-if="files.imagen.length > 0">
                    <div class="progress-bar" :style="{ width: files.imagen[0].progress+'%' }"></div>
                </div>
        </file-upload>
    </div>    
    <span class="help-block" v-show="errors.has('imagen')">(% errors.first('imagen') %)</span>
</div>
<div class="clearfix"></div>