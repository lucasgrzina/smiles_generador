<!-- Nombre Field -->
<div class="form-group col-sm-6" :class="{'has-error': errors.has('nombre')}">
    {!! Form::label('nombre', 'Nombre') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control','v-model' => 'selectedItem.nombre']) !!}
    <span class="help-block" v-show="errors.has('nombre')">(% errors.first('nombre') %)</span>
</div>

<!-- Tipo Field -->
<div class="form-group col-sm-6" :class="{'has-error': errors.has('tipo')}">
    {!! Form::label('tipo', 'Tipo') !!}
   
    <select v-model="selectedItem.tipo" class="form-control" name="tipo" v-validate="'required'" data-vv-validate-on="'none'">
        <option value="null" disabled selected>Seleccione Template</option>
        <option value="header">Header</option>
        <option value="footer">Footer</option>
        <option value="redes">Redes</option>
        <option value="legales">Legales</option>
        <option value="contenido">Contenido</option>
    </select>
    <span class="help-block" v-show="errors.has('tipo')">(% errors.first('tipo') %)</span>
</div>

<!-- Contenido Field -->
<div class="form-group col-sm-12 col-lg-12" :class="{'has-error': errors.has('contenido')}">
    {!! Form::label('contenido', 'Contenido') !!}
    <vue-mce v-model="selectedItem.contenido" :config="tinyConfig"/>
    <span class="help-block" v-show="errors.has('contenido')">(% errors.first('contenido') %)</span>
</div>
<div class="clearfix"></div>