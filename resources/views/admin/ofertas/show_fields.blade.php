<tr>
	<td>{!! Form::label('id', 'Id') !!}</td>
	<td>(% selectedItem.id %)</td>    
</tr>

<tr>
	<td>{!! Form::label('pais_id', 'Pais Id') !!}</td>
	<td>(% selectedItem.pais.nombre %) ((% selectedItem.pais_id %))</td>
</tr>

<tr>
	<td>{!! Form::label('titulo', 'Titulo') !!}</td>
	<td>(% selectedItem.titulo %)</td>    
</tr>

<tr>
	<td>{!! Form::label('imagen', 'Imagen') !!}</td>
	<td>(% selectedItem.imagen %)</td>    
</tr>

<tr>
	<td>{!! Form::label('descripcion', 'Descripcion') !!}</td>
	<td>(% selectedItem.descripcion %)</td>    
</tr>

<tr>
	<td>{!! Form::label('link', 'Link') !!}</td>
	<td>(% selectedItem.link %)</td>    
</tr>

<tr>
	<td>{!! Form::label('orden', 'Orden') !!}</td>
	<td>(% selectedItem.orden %)</td>    
</tr>

<tr>
	<td>{!! Form::label('created_at', 'Created At') !!}</td>
	<td>(% selectedItem.created_at %)</td>    
</tr>

<tr>
	<td>{!! Form::label('updated_at', 'Updated At') !!}</td>
	<td>(% selectedItem.updated_at %)</td>    
</tr>

