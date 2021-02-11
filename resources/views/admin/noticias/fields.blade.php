<!-- Titulo Field -->
<div class="form-group col-sm-6" :class="{'has-error': errors.has('titulo')}">
    {!! Form::label('titulo', 'Título') !!}
    {!! Form::text('titulo', null, ['class' => 'form-control','v-model' => 'selectedItem.titulo']) !!}
    <span class="help-block" v-show="errors.has('titulo')">(% errors.first('titulo') %)</span>
</div>
<!-- Pais Field -->
<div class="form-group col-sm-6" :class="{'has-error': errors.has('pais_id')}">
    {!! Form::label('pais_id', 'País*') !!}
    <select v-model="selectedItem.pais_id" class="form-control" name="pais_id" v-validate="'required'" data-vv-validate-on="'none'">
        <option :value="null">Seleccione</option>
        <option v-for="item in info.paises" :value="item.id">(% item.nombre %)</option>
    </select>
  
    <span class="help-block" v-show="errors.has('pais_id')">(% errors.first('pais_id') %)</span>
</div>
<!-- Imagen Field -->
<div class="form-group col-sm-6" :class="{'has-error': errors.has('imagen')}">
    {!! Form::label('imagen', 'Imagen') !!}
    <div class="thumb-wrap">
        <button-type v-if="selectedItem.imagen" type="remove-list" @click="removeImagen('')"></button-type>
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

<!-- Boton Field -->
<div class="form-group col-sm-6" :class="{'has-error': errors.has('boton')}">
    {!! Form::label('boton', 'Botón texto') !!}
    {!! Form::text('boton', null, ['class' => 'form-control','v-model' => 'selectedItem.boton']) !!}
    <span class="help-block" v-show="errors.has('boton')">(% errors.first('boton') %)</span>
</div>

<!-- Link Field -->
<div class="form-group col-sm-6" :class="{'has-error': errors.has('link')}">
    {!! Form::label('link', 'Botón link') !!}
    {!! Form::text('link', null, ['class' => 'form-control','v-model' => 'selectedItem.link']) !!}
    <span class="help-block" v-show="errors.has('link')">(% errors.first('link') %)</span>
</div>

<!-- Orden Field -->
<div class="form-group col-sm-6" :class="{'has-error': errors.has('orden')}">
    {!! Form::label('orden', 'Orden') !!}
    {!! Form::number('orden', null, ['class' => 'form-control','v-model' => 'selectedItem.orden']) !!}
    <span class="help-block" v-show="errors.has('orden')">(% errors.first('orden') %)</span>
</div>

<!-- Categoria Field -->
<div class="form-group col-sm-6" :class="{'has-error': errors.has('categoria')}">
    {!! Form::label('categoria', 'Categoría') !!}
    {!! Form::text('categoria', null, ['class' => 'form-control','v-model' => 'selectedItem.categoria']) !!}
    <span class="help-block" v-show="errors.has('categoria')">(% errors.first('categoria') %)</span>
</div>
<div class="clearfix"></div>