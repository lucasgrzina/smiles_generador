<div class="table-responsive">
    <table class="table m-b-0" id="contenidoPredefinidos-table">
        <thead>
            <tr>
                <th @click="orderBy('id')" class="td-id" :class="cssOrderBy('id')">ID</th>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Default</th>
                <th class="td-actions">{{ trans('admin.table.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="item in list" v-if="paging.total > 0">
                <td>(% item.id %)</td>
                <td>(% item.nombre %)</td>
                <td>(% nombreTipo(item.tipo) %)</td>
                <td>
                    <span v-if="item.tipo !== 'contenido'" :class="{'label': true, 'label-success': item.default, 'label-danger': !item.default}">
                        (% item.default ? 'SI' : 'NO' %)
                    </span>
                </td>
            
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