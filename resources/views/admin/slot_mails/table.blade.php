<div class="table-responsive">
    <table class="table m-b-0" id="customMails-table">
        <thead>
            <tr style="display: grid; grid-template-columns: 5% 18% 22% 27% 5% auto;">
                <th @click="orderBy('id')"  :class="cssOrderBy('id')">ID</th>
                <th>Nombre</th>
                <th>Templatess</th>
                <th>Fecha de envío</th>
                <th>Piezas slots</th>
                <th class="td-actions">{{ trans('admin.table.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="item in list" v-if="paging.total > 0">
                <td colspan="6">
                    <div style="display: grid; grid-template-columns: 5% 18% 22% 27% 5% auto;">
                        <div style="width: 100%; padding: 0 5px;">(% item.id %) </div>
                        <div style="width: 100%; padding: 0 5px;">(% item.nombre %) </div>
                        <div style="width: 100%; padding: 0 5px;">(% nombreTemplate(item.template) %)</div>
                        <div style="width: 100%; padding: 0 5px;">(% item.fecha_envio | dateFormat %) </div>
                        <div style="width: 100%; padding: 0 5px;z-index: 1;">
                            <button v-if="item.contenidos.length == 0" class="btn btn-xs bg-green" type="button"  @click="createContenido(item)">Crear primero</button>
                            <button v-if="item.contenidos.length > 0" class="btn btn-xs bg-gray" type="button" data-toggle="collapse" :data-target="'#item'+item.id" aria-expanded="false" :aria-controls="'item'+item.id">Mostrar/Ocultar</button>
                        </div>
                        <div style="display: flex;
                            align-items: center;
                            justify-content: end;
                            gap: 4px;">
                            @if(auth()->user()->hasRole('Superadmin') || auth()->user()->can('ver-'.$data['action_perms']))
                            <button-type type="show-list" @click="show(item)" v-if="item.contenidos.length > 0"></button-type>
                            @endif
                            @if(auth()->user()->hasRole('Superadmin') || auth()->user()->can('editar-'.$data['action_perms']))
                            <button-type type="edit-list" @click="edit(item)"></button-type>
                            <button-type type="clone-list" @click="clonar(item)"></button-type>
                            <button-type type="remove-list" @click="destroy(item)"></button-type>
                            @endif
                        </div>
                </div>

                <div class="collapse multi-collapse w-100" :id="'item'+item.id">
                    <div class="card card-body" v-if="item.contenidos.length > 0">
                        
                            <div class="row-content head">
                                <div>ID</div>
                                <div>Nombre</div>
                                <div class="text-right">Acciones</div>
                            </div>
                            <div v-for="contenido in item.contenidos" class="row-content">
                                <div>(% contenido.id %)</div>
                                <div>(% contenido.nombre %)</div>
                                <div class="text-right">
                                    <button-type type="edit-list" @click="editContenido(contenido)"></button-type>
                                    <button-type type="clone-list" @click="clonarContenido(contenido)"></button-type>
                                    <button-type type="remove-list" @click="destroyContenido(contenido)"></button-type>
                                </div>

                            </div>

                       
                        <div style="padding: 10px 0; display: flex; align-items: center;justify-content: end;">
                            <button @click="createContenido(item)" class="btn btn-xs bg-green" type="button" data-toggle="collapse" :data-target="'#item'+item.id" aria-expanded="false" :aria-controls="'item'+item.id"><i class="fa fa-plus m-r-5"></i> Crear nuevo</button>
                        </div>
                    </div>  
                </div>

            </td>



        </tr>


    </tbody>
</table>

</div>