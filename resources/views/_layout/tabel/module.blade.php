@foreach($result as $rS)
	<tr>
		<td>{{ $rS->name }}</td>
		<td>{{$rS->route}}</td>
		<td>{{$rS->description}}</td>
		<td>
			<div class="tools" align='center'>
				<button type="button" id="editModule-{{ $rS->id }}"><i class="fa fa-edit"></i></button type="button">
				<button type="button" id="deleteModule-{{$rS->id}}"><i class="fa fa-trash-o"></i></button type="button">
			</div>
		</td>
	</tr>
@endforeach
