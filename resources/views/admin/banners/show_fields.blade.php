<tr>
	<td>{!! Form::label('id', 'Id') !!}</td>
	<td>(% selectedItem.id %)</td>    
</tr>

<tr>
	<td>{!! Form::label('pais_id', 'País') !!}</td>
	<td>(% selectedItem.pais.nombre %)</td>    
</tr>

<tr>
	<td>{!! Form::label('imagen_web', 'Imagen Web') !!}</td>
	<td>(% selectedItem.imagen_web %)</td>    
</tr>

<tr>
	<td>{!! Form::label('imagen_mobile', 'Imagen Mobile') !!}</td>
	<td>(% selectedItem.imagen_mobile %)</td>    
</tr>

<tr>
	<td>{!! Form::label('created_at', 'Created At') !!}</td>
	<td>(% selectedItem.created_at %)</td>    
</tr>

<tr>
	<td>{!! Form::label('updated_at', 'Updated At') !!}</td>
	<td>(% selectedItem.updated_at %)</td>    
</tr>

