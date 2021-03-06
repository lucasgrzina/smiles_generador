<!-- Nombre Field -->
<div class="form-group col-sm-6" :class="{'has-error': errors.has('nombre')}">
    {!! Form::label('nombre', 'Nombre') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control','v-model' => 'selectedItem.nombre']) !!}
    <span class="help-block" v-show="errors.has('nombre')">(% errors.first('nombre') %)</span>
</div>

<!-- Tipo Field -->
<div class="form-group col-sm-6" :class="{'has-error': errors.has('tipo')}">
    {!! Form::label('tipo', 'Tipo') !!}
   
    <select v-model="selectedItem.tipo" class="form-control" name="tipo">
        <option :value="null">Seleccione</option>
        <option v-for="(item,index) in info.tipos" :value="index">(% item %)</option>
    </select>
    <span class="help-block" v-show="errors.has('tipo')">(% errors.first('tipo') %)</span>
</div>

<!-- Contenido Field -->
<div class="form-group col-sm-12 col-lg-12" :class="{'has-error': errors.has('contenido')}">
    {!! Form::label('contenido', 'Contenido') !!}
    <vue-mce v-model="selectedItem.contenido" :config="tinyConfig"/>
    <span class="help-block" v-show="errors.has('contenido')">(% errors.first('contenido') %)</span>
</div>

<div class="form-group col-sm-6" :class="{'has-error': errors.has('default')}" v-if="selectedItem.tipo !== 'contenido'">
    {!! Form::label('default', 'Default') !!}<br>
    <!--input type="checkbox" :value="perm" v-model="selectedItem.default"-->
    <switch-button v-model="selectedItem.default" theme="bootstrap" type-bold="true"></switch-button>
    <span class="help-block" v-show="errors.has('default')">(% errors.first('default') %)</span>
</div>
<div class="clearfix"></div>