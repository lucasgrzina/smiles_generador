<div class="table-responsive">
    <table class="table m-b-0" id="entrenamientos-table">
        <thead>
            <tr>
                <th @click="orderBy('id')" class="td-id" :class="cssOrderBy('id')">ID</th>
                <th>Pais Id</th>
                <th>Titulo</th>
                <th>Descripcion</th>
                <th>Tipo</th>
                <th>Archivo</th>
                <th>Video</th>
                <th>Orden</th>
                <th class="td-actions">{{ trans('admin.table.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="item in list" v-if="paging.total > 0">
                <td>(% item.id %)</td>
                <td>(% item.pais_id %)</td>
                <td>(% item.titulo %)</td>
                <td>(% item.descripcion %)</td>
                <td>(% item.tipo %)</td>
                <td>(% item.archivo %)</td>
                <td>(% item.video %)</td>
                <td>(% item.orden %)</td>
                <td class="td-actions">
                    @if(auth()->user()->hasRole('Superadmin') || auth()->user()->can('ver-'.$data['action_perms']))
                        <button-type type="show-list" @click="show(item)"></button-type>
                    @endif
                    @if(auth()->user()->hasRole('Superadmin') || auth()->user()->can('editar-'.$data['action_perms']))
                        <button-type type="edit-list" @click="edit(item)"></button-type>
                        <button-type type="remove-list" @click="destroy(item)"></button-type>
                    @endif
                </td>            
            </tr>
        </tbody>
    </table>
</div>