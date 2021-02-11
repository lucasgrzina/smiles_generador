<div class="table-responsive">
    <table class="table m-b-0" id="banners-table">
        <thead>
            <tr>
                <th @click="orderBy('id')" class="td-id" :class="cssOrderBy('id')">ID</th>
                <th>País</th>
                <th>Tipo</th>
                <th>Sección</th>
                <th>Imagen Web</th>
                <th>Imagen Mobile</th>
                <th class="td-actions">{{ trans('admin.table.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="item in list" v-if="paging.total > 0">
                <td>(% item.id %)</td>
                <td>(% item.pais.nombre %) ((% item.pais.nombre %))</td>
                <td>(% item.tipo === 'T' ? 'Top' : 'Bottom' %)</td>
                <td>(% item.seccion %)</td>
                <td><img style="width:50px" :src="item.imagen_web_url"></td>
                <td>
                    <img v-if="item.imagen_mobile" style="width:50px" :src="item.imagen_mobile_url">
                </td>
                <td class="td-actions">
                    @if(auth()->user()->hasRole('Superadmin') || auth()->user()->can('editar-'.$data['action_perms']))
                        <button-type type="edit-list" @click="edit(item)"></button-type>
                        <button-type type="remove-list" @click="destroy(item)"></button-type>
                    @endif
                </td>            
            </tr>
        </tbody>
    </table>
</div>