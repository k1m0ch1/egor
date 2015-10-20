@foreach($result as $rS)
	<tr>
		<td>{{ $rS->role_dn }}</td>
		<td>{{ $rS->per_dn }} {{ $rS->menu_nama }}</td>
		<td>
			<div class="tools" align='center'>
				<button type="button" id="deletePermission-{{$rS->rID}}-{{$rS->pID}}"><i class="fa fa-trash-o"></i></button type="button">
					<input type='hidden' value="{{$rS->rID}}" id="role_id" />
			</div>
		</td>
	</tr>
@endforeach
