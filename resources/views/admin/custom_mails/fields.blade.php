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
   
    <select :disabled="true" v-model="selectedItem.template" class="form-control" name="template" v-validate="'required'" data-vv-validate-on="'none'">
        <option :value="null">Seleccione Template</option>
        <option v-for="(item,index) in info.templates" :value="index">(% item %)</option>
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

<div class="form-group col-sm-12" >
    <h3>Contenido</h3><hr>    
</div>
<div class="col-sm-12">

    <draggable id="accordion" v-model="listContents" @end="checkMove">
      <div class="card rowContent" v-for="item in listContents" :index="item.index">
        <div class="card-header" :id="'heading'+item.index">
          <h5 class="mb-0">
            <button class="btn btn-content" data-toggle="collapse" :data-target="'#'+item.index" aria-expanded="false" :aria-controls="item.index">(% item.nombre %)
              <span v-if="item.id == 'separador1'"> | (% item.input %)px <span>
            </button>
            <button class="btn btn-sm btn-eliminar" @click="removerItem(item.index)">Eliminar item</button>
          </h5>
        </div>

        <div :id="item.index" class="collapse" :aria-labelledby="'heading'+item.index" data-parent="#accordion">
          <div class="card-body">
            <div v-if="item.id == 'imagen1'">
                <div class="form-group col-sm-3"></div>
                <div class="form-group col-sm-6">
                    <!-- Items link-->
                    <div class="row" style="margin-bottom: 15px;">
                        <div class="col-sm-12">
                            <label>Website URL</label>
                            <input class="form-control" type="text" name="" v-model="item.link" @change="exportar">
                            <div class="FormControl-info">
                                The full website URL (e.g. <code>https://www.example.com</code>)
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-bottom: 15px;">
                        <div class="col-sm-12">
                            <label>Campaign Source</label>
                            <input class="form-control" type="text" name="" v-model="item.utm_source" @change="exportar">
                            <div class="FormControl-info">
                                The referrer: (e.g.&nbsp;<code>google</code>,&nbsp;<code>newsletter</code>)
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-bottom: 15px;">
                        <div class="col-sm-12">
                            <label>Campaign Medium</label>
                            <input class="form-control" type="text" name="" v-model="item.utm_medium" @change="exportar">
                            <div class="FormControl-info">
                                Marketing medium: (e.g.&nbsp;<code>cpc</code>,&nbsp;<code>banner</code>,&nbsp;<code>email</code>)
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-bottom: 15px;">
                        <div class="col-sm-12">
                            <label>Campaign Name</label>
                            <input class="form-control" type="text" name="" v-model="item.utm_campaign" @change="exportar">
                            <div class="FormControl-info">
                                Product, promo code, or slogan (e.g. <code>spring_sale</code>)
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-bottom: 15px;">
                        <div class="col-sm-12">
                            <label>Campaign Term</label>
                            <input class="form-control" type="text" name="" v-model="item.utm_term" @change="exportar">
                            <div class="FormControl-info">
                                Identify the paid keywords
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-bottom: 15px;">
                        <div class="col-sm-12">
                            <label>Campaign Content</label>
                            <input class="form-control" type="text" name="" v-model="item.utm_content" @change="exportar">
                            <div class="FormControl-info">
                                Use to differentiate ads
                            </div>
                        </div>
                    </div>

                    <!-- End Items link-->
                   
                    <label>Url</label>
                    <input class="form-control" type="text" name="" v-model="item.input" @change="exportar">
                </div>
            </div>
            <div v-if="item.id == 'imagen2'">
                <div class="form-group col-sm-6">
                    <!-- Items link-->
                    <div class="row" style="margin-bottom: 15px;">
                        <div class="col-sm-12">
                            <label>Website URL</label>
                            <input class="form-control" type="text" name="" v-model="item.link" @change="exportar">
                            <div class="FormControl-info">
                                The full website URL (e.g. <code>https://www.example.com</code>)
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-bottom: 15px;">
                        <div class="col-sm-12">
                            <label>Campaign Source</label>
                            <input class="form-control" type="text" name="" v-model="item.utm_source" @change="exportar">
                            <div class="FormControl-info">
                                The referrer: (e.g.&nbsp;<code>google</code>,&nbsp;<code>newsletter</code>)
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-bottom: 15px;">
                        <div class="col-sm-12">
                            <label>Campaign Medium</label>
                            <input class="form-control" type="text" name="" v-model="item.utm_medium" @change="exportar">
                            <div class="FormControl-info">
                                Marketing medium: (e.g.&nbsp;<code>cpc</code>,&nbsp;<code>banner</code>,&nbsp;<code>email</code>)
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-bottom: 15px;">
                        <div class="col-sm-12">
                            <label>Campaign Name</label>
                            <input class="form-control" type="text" name="" v-model="item.utm_campaign" @change="exportar">
                            <div class="FormControl-info">
                                Product, promo code, or slogan (e.g. <code>spring_sale</code>)
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-bottom: 15px;">
                        <div class="col-sm-12">
                            <label>Campaign Term</label>
                            <input class="form-control" type="text" name="" v-model="item.utm_term" @change="exportar">
                            <div class="FormControl-info">
                                Identify the paid keywords
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-bottom: 15px;">
                        <div class="col-sm-12">
                            <label>Campaign Content</label>
                            <input class="form-control" type="text" name="" v-model="item.utm_content" @change="exportar">
                            <div class="FormControl-info">
                                Use to differentiate ads
                            </div>
                        </div>
                    </div>

                    <!-- End Items link-->
                    <label>Url</label>
                    <input class="form-control" type="text" name="" v-model="item.input" @change="exportar">
                </div>
                <div class="form-group col-sm-6">
                    <!-- Items link-->
                    <div class="row" style="margin-bottom: 15px;">
                        <div class="col-sm-12">
                            <label>Website URL</label>
                            <input class="form-control" type="text" name="" v-model="item.link2" @change="exportar">
                            <div class="FormControl-info">
                                The full website URL (e.g. <code>https://www.example.com</code>)
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-bottom: 15px;">
                        <div class="col-sm-12">
                            <label>Campaign Source</label>
                            <input class="form-control" type="text" name="" v-model="item.utm_source2" @change="exportar">
                            <div class="FormControl-info">
                                The referrer: (e.g.&nbsp;<code>google</code>,&nbsp;<code>newsletter</code>)
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-bottom: 15px;">
                        <div class="col-sm-12">
                            <label>Campaign Medium</label>
                            <input class="form-control" type="text" name="" v-model="item.utm_medium2" @change="exportar">
                            <div class="FormControl-info">
                                Marketing medium: (e.g.&nbsp;<code>cpc</code>,&nbsp;<code>banner</code>,&nbsp;<code>email</code>)
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-bottom: 15px;">
                        <div class="col-sm-12">
                            <label>Campaign Name</label>
                            <input class="form-control" type="text" name="" v-model="item.utm_campaign2" @change="exportar">
                            <div class="FormControl-info">
                                Product, promo code, or slogan (e.g. <code>spring_sale</code>)
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-bottom: 15px;">
                        <div class="col-sm-12">
                            <label>Campaign Term</label>
                            <input class="form-control" type="text" name="" v-model="item.utm_term2" @change="exportar">
                            <div class="FormControl-info">
                                Identify the paid keywords
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-bottom: 15px;">
                        <div class="col-sm-12">
                            <label>Campaign Content</label>
                            <input class="form-control" type="text" name="" v-model="item.utm_content2" @change="exportar">
                            <div class="FormControl-info">
                                Use to differentiate ads
                            </div>
                        </div>
                    </div>

                    <!-- End Items link-->
                    <label>Url</label>
                    <input class="form-control" type="text" name="" v-model="item.input2" @change="exportar">
                </div>
            </div>
            <div v-if="item.id == 'textolibre'">
                <div class="form-group col-sm-12">
                    <vue-mce v-model="item.input" @change="exportar"/>
                </div>
            </div>

            <div v-if="item.id == 'textoplano'">
                <div class="form-group col-sm-12">
                     <vue-mce v-model="item.input" @change="exportar"/>
                </div>
            </div>

            <div v-if="item.id == 'separador1'">
                <div class="form-group col-sm-3"></div>
                <div class="form-group col-sm-6">
                    <span class="text-center" style="width: 100%; position: relative; float: left; margin-bottom: 8px;">Separador en blanco horizontal valor default 30px de alto.</span>
                    <input class="form-control" type="number" name="" v-model="item.input" @change="exportar">
                </div>
            </div>

            <div v-if="item.id == 'contenido_predefinido'">
                <div class="form-group col-sm-12">
                    <div class="form-group col-sm-3" ></div>
                    <div class="form-group col-sm-6" >
                        <input class="form-control"  type="hidden" name="" v-model="item.id" :id="'contenidohtml_'+item.unique" @change="exportar">
                       <select class="form-control" v-model="item.predefinido" name="tipo_redes" @change=" viewContent($event, 'preview_'+item.unique, item)">
                        <option :value="null">Seleccione</option>
                        <option :value="item.id" v-for="item in info.tipo_contenido">(% item.nombre %)</option>
                        </select>
                        
                    </div>
                    <div class="preview" :id="'preview_'+item.unique" v-html="item.contenidohtml"></div>
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
    <!-- Nombre Field -->
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

<div class="form-group col-sm-12" >
    <h3>Legales</h3><hr>
    <!-- Nombre Field -->
    <div class="form-group col-sm-6" :class="{'has-error': errors.has('legales')}" style="display: none;">
        {!! Form::label('legales', 'Legales Json') !!}
        {!! Form::text('legales', null, ['class' => 'form-control','v-model' => 'selectedItem.legales']) !!}
        <span class="help-block" v-show="errors.has('legales')">(% errors.first('legales') %)</span>
    </div> 

    <div class="form-group col-sm-6" >
        {!! Form::label('tipo_legales', 'Genérico') !!}
       <select class="form-control" v-model="info.legales_id" name="tipo-legales" @change="selectLegales($event, 'predefinido')">
            <option :value="''">Ninguno</option>
            <option :value="item.id" v-for="item in info.tipo_legales">(% item.nombre %)</option>
        </select>
    </div>
    <!-- Contenido Field -->
    <div class="form-group col-sm-12 col-lg-12" :class="{'has-error': errors.has('legales_custom')}">
        {!! Form::label('legales_custom', 'Específico') !!}
        <vue-mce v-model="info.legales_custom" :config="tinyConfig" @change="selectLegales($event, 'legales_custom')"/>
        <span class="help-block" v-show="errors.has('legales_custom')">(% errors.first('legales_custom') %)</span>
    </div>
</div>