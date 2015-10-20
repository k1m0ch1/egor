<div class='col-md-6'>
	<div class="form-group">
		<label for="name">Name</label>
		<input type="text" name="name" id="name" value="{{ $rS[0]->name }}" class="form-control">
		<label for="displayName">Display Name</label>
		<input type="text" name="displayName" id="displayName" value="{{ $rS[0]->display_name}}" class="form-control">
		<label for="permission">Permission</label>
		<select id="permission" name="permission">
			@foreach($rS2 as $rs)
			<option value="{{ $rs->id }}">{{ $rs->name }}</option>
			@endforeach
		</select>
		<select id="access" name="access">
			<option value="self">Sendiri</option>
			<option value="module">Module</option>
			<option value="app">Aplikasi</option>
		</select>
		<div id="access-action" class="input-group">

		</div>
	</div>
</div>
<div class='col-md-6'>
	<label for="description">Description</label>
	<textarea id="description" class="form-control" cols=3 rows=6>{{ $rS[0]->description }}</textarea>
</div>
<input type="submit" tabindex="-1" style="position:absolute; top:-1000px" id='simpanData'>
<input type='hidden' id='id' value='{{ $rS[0]->id }}' />
<script>
$(document).ready(function(){
	$('select#access').on('change', function(){
		var access = $( "#access option:selected" ).val();
		console.log(access);
		var link = access=="app"?'admin/dashboard[show:app]':access=="self"?'':access=="module"?'':"";
		$.ajax({
			url:  host + link,
			type: 'GET',
			data: { access: access },
			dataType: 'html',
			success: function(data) {
				$('#access-action').html(data);
			}
		});
	});
});
</script>
