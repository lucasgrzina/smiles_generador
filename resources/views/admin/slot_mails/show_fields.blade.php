<tr>
	<td>{!! Form::label('id', 'Id') !!}</td>
	<td>(% selectedItem.id %)</td>    
</tr>

<tr>
	<td>{!! Form::label('nombre', 'Nombre') !!}</td>
	<td>(% selectedItem.nombre %)</td>    
</tr>

<tr>
	<td>{!! Form::label('publicidad', 'Publicidad') !!}</td>
	<td>(% selectedItem.publicidad %)</td>    
</tr>

<tr>
	<td>{!! Form::label('template', 'Template') !!}</td>
	<td>(% selectedItem.template %)</td>    
</tr>

<tr>
	<td>{!! Form::label('created_at', 'Alta') !!}</td>
	<td>(% selectedItem.created_at | datetimeFormat %)</td>    
</tr>

<tr>
	<td>{!! Form::label('updated_at', 'Ult. Modif.') !!}</td>
	<td>(% selectedItem.updated_at | datetimeFormat %)</td>    
</tr>

