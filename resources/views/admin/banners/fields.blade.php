<!-- Seccion Id Field -->
<div class="form-group col-sm-12" :class="{'has-error': errors.has('tipo')}">
    {!! Form::label('seccion', 'Seccion*') !!}
    <select v-model="selectedItem.seccion" class="form-control" name="seccion" v-validate="'required'" data-vv-validate-on="'none'">
        <option :value="null">Seleccione</option>
        <option :value="'home'">Home</option>
        <option :value="'entrenamiento'">Entrenamiento</option>
        <option :value="'ofertas'">Ofertas exclusivas</option>
        <option :value="'materiales'">Materiales</option>
        <option :value="'contacto'">Contacto</option>
    </select>
  
    <span class="help-block" v-show="errors.has('tipo')">(% errors.first('tipo') %)</span>
</div>
<!-- Retail Id Field -->
<div class="form-group col-sm-6" :class="{'has-error': errors.has('pais_id')}">
    {!! Form::label('pais_id', 'País*') !!}
    <select v-model="selectedItem.pais_id" class="form-control" name="pais_id" v-validate="'required'" data-vv-validate-on="'none'">
        <option :value="null">Seleccione</option>
        <option v-for="item in info.paises" :value="item.id">(% item.nombre %)</option>
    </select>
  
    <span class="help-block" v-show="errors.has('pais_id')">(% errors.first('pais_id') %)</span>
</div>
<!-- Tipo Id Field -->
<div class="form-group col-sm-6" :class="{'has-error': errors.has('tipo')}">
    {!! Form::label('tipo', 'Tipo*') !!}
    <select v-model="selectedItem.tipo" class="form-control" name="tipo" v-validate="'required'" data-vv-validate-on="'none'">
        <option :value="null">Seleccione</option>
        <option :value="'T'">Top</option>
        <option :value="'B'">Bottom</option>
    </select>
  
    <span class="help-block" v-show="errors.has('tipo')">(% errors.first('tipo') %)</span>
</div>
<div class="clearfix"></div>
<div class="form-group col-sm-6" :class="{'has-error': errors.has('imagen_web')}">
    {!! Form::label('imagen_web', 'Imagen (WEB)') !!}
    <div class="thumb-wrap">
        <button-type v-if="selectedItem.imagen_web" type="remove-list" @click="removeImagen('web')"></button-type>
        <file-upload
            
            :multiple="false"
            :headers="_fuHeader"
            ref="uploadImagenWeb"
            extensions="gif,jpg,jpeg,png,webp,svg"
            accept="image/png,image/gif,image/jpeg,image/webp,image/svg"            
            input-id="imagenweb"
            v-model="files.imagen_web"
            post-action="{{ route('uploads.store-file') }}"
            @input-file="inputImagenWeb"
            class="thumbnail">
                <img class="img-responsive" src="{{ asset('admin/img/generic-upload.png') }}" v-if="!selectedItem.imagen_web_url">
                <img class="img-responsive" :src="selectedItem.imagen_web_url" v-else>
                <div class="progress m-t-5 m-b-0" v-if="files.imagen_web.length > 0">
                    <div class="progress-bar" :style="{ width: files.imagen_web[0].progress+'%' }"></div>
                </div>
        </file-upload>
    </div>    
    <span class="help-block" v-show="errors.has('imagen_web')">(% errors.first('imagen_web') %)</span>
</div>

<div class="form-group col-sm-6" :class="{'has-error': errors.has('imagen_mobile')}">
    {!! Form::label('imagen_mobile', 'Imagen (Mobile)') !!}
    <div class="thumb-wrap">
        <button-type v-if="selectedItem.imagen_mobile" type="remove-list" @click="removeImagen('mobile')"></button-type>
        <file-upload
            
            :multiple="false"
            :headers="_fuHeader"
            ref="uploadImagenMobile"
            extensions="gif,jpg,jpeg,png,webp,svg"
            accept="image/png,image/gif,image/jpeg,image/webp,image/svg"            
            input-id="imagenmobile"
            v-model="files.imagen_mobile"
            post-action="{{ route('uploads.store-file') }}"
            @input-file="inputImagenMobile"
            class="thumbnail">
                <img class="img-responsive" src="{{ asset('admin/img/generic-upload.png') }}" v-if="!selectedItem.imagen_mobile_url">
                <img class="img-responsive" :src="selectedItem.imagen_mobile_url" v-else>
                <div class="progress m-t-5 m-b-0" v-if="files.imagen_mobile.length > 0">
                    <div class="progress-bar" :style="{ width: files.imagen_mobile[0].progress+'%' }"></div>
                </div>
        </file-upload>
    </div>    
    <span class="help-block" v-show="errors.has('imagen_mobile')">(% errors.first('imagen_mobile') %)</span>
</div>
