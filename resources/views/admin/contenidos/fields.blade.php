<!-- Titulo Field -->
<div class="form-group col-sm-6" :class="{'has-error': errors.has('titulo')}">
    {!! Form::label('titulo', 'Titulo') !!}
    {!! Form::text('titulo', null, ['class' => 'form-control','v-model' => 'selectedItem.titulo']) !!}
    <span class="help-block" v-show="errors.has('titulo')">(% errors.first('titulo') %)</span>
</div>

<!-- Categoria Id Field -->
<div class="form-group col-sm-6" :class="{'has-error': errors.has('categoria_id')}">
    {!! Form::label('categoria_id', 'Categoría*') !!}
    <select v-model="selectedItem.categoria_id" class="form-control" name="categoria_id" v-validate="'required'" data-vv-validate-on="'none'">
        <option :value="null">Seleccione</option>
        <option v-for="item in info.categorias" :value="item.id">(% item.nombre %)</option>
    </select>
  
    <span class="help-block" v-show="errors.has('categoria_id')">(% errors.first('categoria_id') %)</span>
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

<!-- Archivo Field -->


<div class="form-group col-sm-6" :class="{'has-error': errors.has('archivo')}" >
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
                <div style="width: 100%; text-align: left;"  v-else>
                    <i class="fa fa-file" style="font-size: 25px; margin-right: 5px;"> </i>
                   <span >
                    (% selectedItem.archivo_url %)</span>
                </div>
                <div class="progress m-t-5 m-b-0" v-if="files.archivo.length > 0">
                    <div class="progress-bar" :style="{ width: files.archivo[0].progress+'%' }"></div>
                </div>
        </file-upload>
    </div>    
    <span class="help-block" v-show="errors.has('archivo')">(% errors.first('archivo') %)</span>
</div>

<!-- Descripcion Field -->
<div class="form-group col-sm-12 col-lg-12" :class="{'has-error': errors.has('descripcion')}">
    {!! Form::label('descripcion', 'Descripcion') !!}
    {!! Form::textarea('descripcion', null, ['class' => 'form-control','v-model' => 'selectedItem.descripcion']) !!}
    <span class="help-block" v-show="errors.has('descripcion')">(% errors.first('descripcion') %)</span>
</div>

<div class="col-xs-12">
    <div class="table-responsive">
        <table class="table table-condensed">
            <tr>
                
                <th width="70%">Paises</th>
              
            </tr>
            <tr v-for="item in selectedItem.paisesList">
                
                <td>(% item.nombre %)</td>
                
                <td>
                    <input type="checkbox" class="input-xs" v-model="item.selected">
                </td>
            </tr>
        </table>
    </div>
</div>

<div class="form-group col-sm-12" :class="{'has-error': errors.has('tags')}">
    {!! Form::label('tags', 'Tags') !!}
    <tags-input element-id="tags"
    v-model="selectedItem.tags"
    :existing-tags="info.tags"
    placeholder="Agregar tag"
    :only-existing-tags="true"
    :typeahead-activation-threshold="0"
    :typeahead="true"></tags-input>
    <span class="help-block" v-show="errors.has('tags')">(% errors.first('tags') %)</span>
</div>

<!-- Producto Id Field -->
<div class="form-group col-sm-6" :class="{'has-error': errors.has('producto_id')}">
    {!! Form::label('producto_id', 'Producto*') !!}
    <select v-model="selectedItem.producto_id" class="form-control" name="producto_id" v-validate="'required'" data-vv-validate-on="'none'">
        <option :value="null">Seleccione</option>
        <option v-for="item in info.productos" :value="item.id">(% item.nombre %)</option>
    </select>
  
    <span class="help-block" v-show="errors.has('producto_id')">(% errors.first('producto_id') %)</span>
</div>
<div class="clearfix"></div>