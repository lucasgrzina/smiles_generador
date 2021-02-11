<!-- Pais Id Field -->
<div class="form-group col-sm-6" :class="{'has-error': errors.has('pais_id')}">
    {!! Form::label('pais_id', 'País*') !!}
    <select v-model="selectedItem.pais_id" class="form-control" name="pais_id" v-validate="'required'" data-vv-validate-on="'none'">
        <option :value="null">Seleccione</option>
        <option v-for="item in info.paises" :value="item.id">(% item.nombre %)</option>
    </select>
  
    <span class="help-block" v-show="errors.has('pais_id')">(% errors.first('pais_id') %)</span>
</div>

<!-- Titulo Field -->
<div class="form-group col-sm-6" :class="{'has-error': errors.has('titulo')}">
    {!! Form::label('titulo', 'Titulo') !!}
    {!! Form::text('titulo', null, ['class' => 'form-control','v-model' => 'selectedItem.titulo']) !!}
    <span class="help-block" v-show="errors.has('titulo')">(% errors.first('titulo') %)</span>
</div>

<!-- Descripcion Field -->
<div class="form-group col-sm-12 col-lg-12" :class="{'has-error': errors.has('descripcion')}">
    {!! Form::label('descripcion', 'Descripcion') !!}
    {!! Form::textarea('descripcion', null, ['class' => 'form-control','v-model' => 'selectedItem.descripcion']) !!}
    <span class="help-block" v-show="errors.has('descripcion')">(% errors.first('descripcion') %)</span>
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
                <img class="img-responsive" src="{{ asset('admin/img/generic-upload.png') }}" v-if="!selectedItem.imagen">
                <img class="img-responsive" :src="selectedItem.imagen_url" v-else>
                <div class="progress m-t-5 m-b-0" v-if="files.imagen.length > 0">
                    <div class="progress-bar" :style="{ width: files.imagen[0].progress+'%' }"></div>
                </div>
        </file-upload>
    </div>    
    <span class="help-block" v-show="errors.has('imagen')">(% errors.first('imagen') %)</span>
</div>

<!-- Tipo Field -->
<div class="form-group col-sm-6" :class="{'has-error': errors.has('tipo')}">
    {!! Form::label('tipo', 'Tipo*') !!}
    <select v-model="selectedItem.tipo" @change="onChangeTipo($event)" class="form-control" name="tipo" v-validate="'required'" data-vv-validate-on="'none'">
        <option :value="null">Seleccione</option>
        <option :value="'V'" selected="">Video</option>
        <option :value="'A'">Archivo</option>
    </select>
  
    <span class="help-block" v-show="errors.has('tipo')">(% errors.first('tipo') %)</span>
</div>

<!-- Archivo Field -->


<div class="form-group col-sm-6" :class="{'has-error': errors.has('archivo')}" v-if="selectedItem.tipo == 'A'">
    {!! Form::label('archivo', 'Archivo') !!}
    <div class="">
      
        <file-upload
            
            :multiple="false"
            :headers="_fuHeader"
            ref="uploadArchivo"
            extensions=""
            accept="*"           
            input-id="archivo"
            v-model="files.archivo"
            post-action="{{ route('uploads.store-file') }}"
            @input-file="inputArchivo"
            class="">
                <img class="img-responsive" src="{{ asset('admin/img/generic-upload.png') }}" v-if="!selectedItem.archivo" style="max-width: 100px;">
                <div style="width: 100%;"  v-else>
                    <i class="fa fa-file" style="font-size: 25px; margin-right: 5px;"> </i>
                    <span>(% selectedItem.archivo_url %)</span>
                </div>
                <div class="progress m-t-5 m-b-0" v-if="files.archivo.length > 0">
                    <div class="progress-bar" :style="{ width: files.archivo[0].progress+'%' }"></div>
                </div>
        </file-upload>
    </div>    
    <span class="help-block" v-show="errors.has('archivo')">(% errors.first('archivo') %)</span>
</div>


<!-- Video Field -->
<div class="form-group col-sm-12" :class="{'has-error': errors.has('video')}" v-if="selectedItem.tipo == 'V'">
    {!! Form::label('video', 'Video') !!}
    {!! Form::textarea('video', null, ['class' => 'form-control','v-model' => 'selectedItem.video']) !!}
    <span class="help-block" v-show="errors.has('video')">(% errors.first('video') %)</span>
</div>

<!-- Orden Field -->
<div class="form-group col-sm-6" :class="{'has-error': errors.has('orden')}">
    {!! Form::label('orden', 'Orden') !!}
    {!! Form::number('orden', null, ['class' => 'form-control','v-model' => 'selectedItem.orden']) !!}
    <span class="help-block" v-show="errors.has('orden')">(% errors.first('orden') %)</span>
</div>


<!-- Pais Id Field -->
<div class="form-group col-sm-6" :class="{'has-error': errors.has('producto_id')}">
    {!! Form::label('producto_id', 'Producto*') !!}
    <select v-model="selectedItem.producto_id" class="form-control" name="producto_id" v-validate="'required'" data-vv-validate-on="'none'">
        <option :value="null">Seleccione</option>
        <option v-for="item in info.productos" :value="item.id">(% item.nombre %)</option>
    </select>
  
    <span class="help-block" v-show="errors.has('producto_id')">(% errors.first('producto_id') %)</span>
</div>

<div class="clearfix"></div>