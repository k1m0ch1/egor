@foreach($result as $rS)
	<tr>
		<td>{{ $rS->name }}</td>
		<td>{{$rS->display_name}}</td>
		<td>
			<div class="tools" align='center'>
				<button type="button" id="editPermission-{{ $rS->id }}"><i class="fa fa-edit"></i></button type="button">
				<button type="button" id="deletePermission-{{$rS->id}}"><i class="fa fa-trash-o"></i></button type="button">
			</div>
		</td>
	</tr>
@endforeach
