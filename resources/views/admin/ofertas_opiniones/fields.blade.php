<!-- Oferta Id Field -->
<div class="form-group col-sm-6" :class="{'has-error': errors.has('oferta_id')}">
    {!! Form::label('oferta_id', 'Oferta*') !!}
    <select v-model="selectedItem.oferta_id" class="form-control" name="oferta_id" v-validate="'required'" data-vv-validate-on="'none'">
        <option :value="null">Seleccione</option>
        <option v-for="item in info.ofertas" :value="item.id">(% item.titulo %)</option>
    </select>
  
    <span class="help-block" v-show="errors.has('oferta_id')">(% errors.first('oferta_id') %)</span>
</div>

<!-- Valoracion Field -->
<div class="form-group col-sm-6" :class="{'has-error': errors.has('valoracion')}">
    {!! Form::label('valoracion', 'Valoración') !!}
    <select v-model="selectedItem.valoracion" class="form-control" name="valoracion" v-validate="'required'" data-vv-validate-on="'none'">
        <option :value="null">Seleccione</option>
        <option v-for="item in info.valoraciones" :value="item.number">(% item.text %)</option>
    </select>
  
    <span class="help-block" v-show="errors.has('usuario_id')">(% errors.first('usuario_id') %)</span>
</div>

<!-- Comentario Field -->
<div class="form-group col-sm-12 col-lg-12" :class="{'has-error': errors.has('comentario')}">
    {!! Form::label('comentario', 'Comentario') !!}
    {!! Form::textarea('comentario', null, ['class' => 'form-control','v-model' => 'selectedItem.comentario']) !!}
    <span class="help-block" v-show="errors.has('comentario')">(% errors.first('comentario') %)</span>
</div>

<!-- Usuario Id Field -->
<div class="form-group col-sm-6" :class="{'has-error': errors.has('usuario_id')}">
    {!! Form::label('usuario_id', 'Usuario*') !!}
    <select v-model="selectedItem.usuario_id" class="form-control" name="usuario_id" v-validate="'required'" data-vv-validate-on="'none'">
        <option :value="null">Seleccione</option>
        <option v-for="item in info.usuarios" :value="item.id">(% item.nombre %)</option>
    </select>
  
    <span class="help-block" v-show="errors.has('usuario_id')">(% errors.first('usuario_id') %)</span>
</div>
<div class="clearfix"></div>