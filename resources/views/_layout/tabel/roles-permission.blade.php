@if(count($result)>0)
	@foreach($result as $rS)
		<tr>
			<td>{{ $rS->role_dn }}</td>
			<td>{{ $rS->per_dn }} {{ $rS->menu_nama }}</td>
			<td>
				<div class="tools" align='center'>
					<button type="button" id="deletePermission-{{$rS->pID}}-{{$rS->rID}}-{{$rS->action}}"><i class="fa fa-trash-o"></i></button type="button">
				</div>
			</td>
		</tr>
	@endforeach
@endif
@if(count($resultPermission)>0)
	@foreach($resultPermission as $rS)
		<tr>
			<td>{{ $rS->role_dn }}</td>
			<td>{{ $rS->per_dn }} {{ $rS->module_name }}</td>
			<td>
				<div class="tools" align='center'>
					<button type="button" id="deletePermission-{{$rS->pID}}-{{$rS->rID}}-{{$rS->action}}"><i class="fa fa-trash-o"></i></button type="button">
				</div>
			</td>
		</tr>
	@endforeach
@endif
<input type='hidden' value="{{$role_id}}" id="role_id" />

<script>
	$('[id^=deletePermission]').on('click', function(){
		var currentID = $(this).attr('id').split('-');
		var pID = currentID[1];
		var rID = currentID[2];
		var actionID = currentID[3];
		var konpirm = confirm("Yakin Hapus Data ?")
		if(konpirm){
				$.ajax({
					url:  host + 'admin/roles[permission:delete]',
					type: 'GET',
					data: { pID : pID, rID : rID, actionID : actionID },
					dataType: 'html',
					success: function(data) {
							$.ajax({
								url:  host + 'admin/roles[permission:show]',
								type: 'GET',
								data: { id: rID },
								dataType: 'html',
								success: function(data) {
									$('#tbody-permission-roles').html(data);
								}
						});
					}
			});
		}
	});
</script>
