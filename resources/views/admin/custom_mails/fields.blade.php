<!-- Nombre Field -->
<div class="form-group col-sm-6" :class="{'has-error': errors.has('nombre')}">
    {!! Form::label('nombre', 'Nombre') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control','v-model' => 'selectedItem.nombre']) !!}
    <span class="help-block" v-show="errors.has('nombre')">(% errors.first('nombre') %)</span>
</div>

<!-- Nombre Field -->
<div class="form-group col-sm-6" :class="{'has-error': errors.has('contenido')}" style="display: none;">
    {!! Form::label('contenido', 'Contenido') !!}
    {!! Form::text('contenido', null, ['class' => 'form-control','v-model' => 'selectedItem.contenido']) !!}
    <span class="help-block" v-show="errors.has('contenido')">(% errors.first('contenido') %)</span>
</div>

<!-- Template Field -->
<div class="form-group col-sm-6" :class="{'has-error': errors.has('template')}">
    {!! Form::label('template', 'Template') !!}
   
    <select v-model="selectedItem.template" class="form-control" name="template" v-validate="'required'" data-vv-validate-on="'none'">
        <option value="null" disabled selected>Seleccione Template</option>
        <option value="template_1">Template 1</option>
        <option value="template_2">Template 2</option>
        <option value="template_3">Template 3</option>
    </select>
    <span class="help-block" v-show="errors.has('template')">(% errors.first('template') %)</span>
</div>

<div class="form-group col-sm-12" >
    <h3>Header</h3><hr>    
</div>

<!-- Publicidad Field -->
<div class="form-group col-sm-6" :class="{'has-error': errors.has('publicidad')}">
    {!! Form::label('publicidad', 'Publicidad') !!}<br>
    <input type="checkbox" v-model="selectedItem.publicidad">
    <span class="help-block" v-show="errors.has('publicidad')">(% errors.first('publicidad') %)</span>
</div>

<!-- Publicidad Field -->
<div class="form-group col-sm-6" :class="{'has-error': errors.has('saldo')}">
    {!! Form::label('saldo', 'Saldo') !!}<br>
    <input type="checkbox"  v-model="selectedItem.saldo">
    <span class="help-block" v-show="errors.has('saldo')">(% errors.first('saldo') %)</span>
</div>

@include('admin.custom_mails.previewheader')

<div class="form-group col-sm-12" >
    <h3>Contenido</h3><hr>    
</div>
<div class="col-sm-12">

    <draggable id="accordion" v-model="listContents" @end="checkMove">
      <div class="card rowContent" v-for="item in listContents" :index="item.index">
        <div class="card-header" :id="'heading'+item.index">
          <h5 class="mb-0">
            <button class="btn btn-content" data-toggle="collapse" :data-target="'#'+item.index" aria-expanded="false" :aria-controls="item.index">
              (% item.nombre %) 
            </button>
            <button class="btn btn-sm btn-eliminar" @click="removerItem(item.index)">Eliminar item</button>
          </h5>
        </div>

        <div :id="item.index" class="collapse" :aria-labelledby="'heading'+item.index" data-parent="#accordion">
          <div class="card-body">
            <div v-if="item.id == 'imagen1'">
                <div class="form-group col-sm-3"></div>
                <div class="form-group col-sm-6">
                    <label>Link</label>
                    <input class="form-control" type="text" name="" v-model="item.link" @change="exportar">
                    <label>Url</label>
                    <input class="form-control" type="text" name="" v-model="item.input" @change="exportar">
                </div>
            </div>
            <div v-if="item.id == 'imagen2'">
                <div class="form-group col-sm-6">
                    <label>Link</label>
                    <input class="form-control" type="text" name="" v-model="item.link" @change="exportar">
                    <label>Url</label>
                    <input class="form-control" type="text" name="" v-model="item.input" @change="exportar">
                </div>
                <div class="form-group col-sm-6">
                    <label>Link</label>
                    <input class="form-control" type="text" name="" v-model="item.link2" @change="exportar">
                    <label>Url</label>
                    <input class="form-control" type="text" name="" v-model="item.input2" @change="exportar">
                </div>
            </div>
            <div v-if="item.id == 'textolibre'">
                <div class="form-group col-sm-12">
                    <vue-mce v-model="item.input" @change="exportar"/>
                </div>
            </div>

            <div v-if="item.id == 'separador1'">
                <div class="form-group col-sm-12">
                    Separador en blanco horizontal de 30px de alto.
                </div>
            </div>
          </div>
        </div>
      </div>
      
        
        </draggable>
</div>


<div class="col-sm-12">
    <div class="content-buttons-options">
        <button class="btn btn-sm " @click="agregaritem(btntipo.id, btntipo.index)" v-for="btntipo in contenidosTipo">
            (% btntipo.btn %)
        </button>
    </div>
</div>

<div class="form-group col-sm-12" >
    <h3>Footer</h3><hr>    
</div>
