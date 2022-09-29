<div class="box box-info box-cu">
    <div class="box-header with-border">
        <h3 class="box-title">General</h3>
    </div>    
    <div class="box-body">
        <div class="row">
            <!-- Nombre Field -->
            <div class="form-group col-sm-8" :class="{'has-error': errors.has('nombre')}">
                {!! Form::label('nombre', 'Nombre') !!}
                {!! Form::text('nombre', null, ['class' => 'form-control','v-model' => 'selectedItem.nombre']) !!}
                <span class="help-block" v-show="errors.has('nombre')">(% errors.first('nombre') %)</span>
            </div>

            <div class="form-group col-sm-4" :class="{'has-error': errors.has('fecha_envio')}">
                {!! Form::label('fecha_envio', 'Fecha Envío') !!}
                {!! Form::date('fecha_envio', null, ['class' => 'form-control','v-model' => 'selectedItem.fecha_envio']) !!}
                <span class="help-block" v-show="errors.has('fecha_envio')">(% errors.first('fecha_envio') %)</span>
            </div>

            <!-- Nombre Field -->
            <div class="form-group col-sm-6" :class="{'has-error': errors.has('contenido')}" style="display: none;">
                {!! Form::label('contenido', 'Contenido') !!}
                {!! Form::text('contenido', null, ['class' => 'form-control','v-model' => 'selectedItem.contenido']) !!}
                <span class="help-block" v-show="errors.has('contenido')">(% errors.first('contenido') %)</span>
            </div>

            <!-- Template Field -->
            <div class="form-group col-sm-4" :class="{'has-error': errors.has('template')}">
                {!! Form::label('template', 'Template') !!}

                <select :disabled="true" v-model="selectedItem.template" class="form-control" name="template" v-validate="'required'" data-vv-validate-on="'none'">
                    <option :value="null">Seleccione Template</option>
                    <option v-for="(item,index) in info.templates" :value="index">(% item %)</option>
                </select>
                <span class="help-block" v-show="errors.has('template')">(% errors.first('template') %)</span>
            </div>


        </div>
    </div>
</div>

<template >
    <div class="box box-cu" >
        <div class="box-header with-border">
            <h3 class="box-title">Header</h3>
        </div>    
        <div class="box-body">
            <div class="row">
                <!-- Publicidad Field -->
                <div class="form-group col-sm-6" :class="{'has-error': errors.has('publicidad')}">
                    {!! Form::label('publicidad', 'Publicidad') !!}<br>
                    <switch-button v-model="selectedItem.publicidad" theme="bootstrap" type-bold="true"></switch-button>
                    <span class="help-block" v-show="errors.has('publicidad')">(% errors.first('publicidad') %)</span>
                </div>

                <!-- Publicidad Field -->
                <div class="form-group col-sm-6" :class="{'has-error': errors.has('saldo')}">
                    {!! Form::label('saldo', 'Saldo') !!}<br>
                    <switch-button v-model="selectedItem.saldo" theme="bootstrap" type-bold="true"></switch-button>
                    <span class="help-block" v-show="errors.has('saldo')">(% errors.first('saldo') %)</span>
                </div>
            </div>
        </div>
    </div>


    <div class="box box-cu" v-if="selectedItem.id > 0">
        <div class="box-header with-border">
            <h3 class="box-title">Contenido</h3>
        </div>    
        <div class="box-body">
            <div class="row">
                <div class="col-12">
                    <div class="content-buttons-options">
                        <a class="btn btn-sm " :href="info.link_create">
                            Crear contenido
                        </a>
                    </div>
                </div>
            </div>
        </div> 
    </div>
    

    <div class="box box-cu">
        <div class="box-header with-border">
            <h3 class="box-title">Footer</h3>
        </div>    
        <div class="box-body">
            <div class="row">
                <div class="form-group col-sm-6" :class="{'has-error': errors.has('footer')}" style="display: none;">
                    {!! Form::label('footer', 'Footer') !!}
                    {!! Form::text('footer', null, ['class' => 'form-control','v-model' => 'selectedItem.footer']) !!}
                    <span class="help-block" v-show="errors.has('footer')">(% errors.first('footer') %)</span>
                </div>
                <div class="form-group col-sm-6" >
                    {!! Form::label('tipo-footer', 'Footer') !!}
                    <select class="form-control" v-model="info.footer_id" name="tipo-footer" @change="selectFooter($event, 'footer')">
                        <option :value="null">Seleccione</option>
                        <option :value="item.id" v-for="item in info.tipo_footer">(% item.nombre %)</option>
                    </select>
                </div>

                <div class="form-group col-sm-6" >
                    {!! Form::label('tipo-footer', 'Redes') !!}
                    <select class="form-control" v-model="info.redes_id" name="tipo_redes" @change="selectFooter($event, 'redes')">
                        <option :value="null">Seleccione</option>
                        <option :value="item.id" v-for="item in info.tipo_redes">(% item.nombre %)</option>
                    </select>
                </div>
            </div>
        </div>
    </div>


</template>