<tr>
	<td>{!! Form::label('id', 'Id') !!}</td>
	<td>(% selectedItem.id %)</td>    
</tr>

<tr>
	<td>{!! Form::label('nombre', 'Nombre') !!}</td>
	<td>(% selectedItem.nombre %)</td>    
</tr>

<tr>
	<td>{!! Form::label('tipo', 'Tipo') !!}</td>
	<td>(% nombreTipo(selectedItem.tipo) %)</td>    
</tr>

<tr>
	<td>{!! Form::label('contenido', 'Contenido') !!}</td>
	<td>
		<div v-html="selectedItem.contenido"></div> 
	</td>    
</tr>

<tr>
	<td>{!! Form::label('created_at', 'Alta') !!}</td>
	<td>(% selectedItem.created_at | datetimeFormat %)</td>    
</tr>

<tr>
	<td>{!! Form::label('updated_at', 'Ult. Modif.') !!}</td>
	<td>(% selectedItem.updated_at | datetimeFormat %)</td>    
</tr>