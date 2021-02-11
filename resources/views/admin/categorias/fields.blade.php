<!-- Nombre Field -->
<div class="form-group col-sm-6" :class="{'has-error': errors.has('nombre')}">
    {!! Form::label('nombre', 'Nombre') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control','v-model' => 'selectedItem.nombre']) !!}
    <span class="help-block" v-show="errors.has('nombre')">(% errors.first('nombre') %)</span>
</div>

<!-- Orden Field -->
<div class="form-group col-sm-6" :class="{'has-error': errors.has('orden')}">
    {!! Form::label('orden', 'Orden') !!}
    {!! Form::text('orden', null, ['class' => 'form-control','v-model' => 'selectedItem.orden']) !!}
    <span class="help-block" v-show="errors.has('orden')">(% errors.first('orden') %)</span>
</div>
<div class="clearfix"></div>