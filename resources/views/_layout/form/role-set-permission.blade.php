<div id="form-group">
  <label for="permission_id">Permission</label>
  <select id="permission_id" name="permission_id" class='form-control'>
    @foreach($result as $rS)
    <option value="{{ $rS->id }}">{{ $rS->display_name }}</option>
    @endforeach
  </select>
  <select id="access" name="access" class='form-control'>
    <option value="self">-- Pilih --</option>
    <option value="module">Module</option>
    <option value="app">Aplikasi</option>
  </select>
  <div id="access-action" >
    <select class='form-control'>
      <option>--- Unavailable ---</option>
    </select>
  </div>
</div>
<input type='hidden' id='role_id' name='role_id' value="{{ $role_id }}" />
<input type="submit" tabindex="-1" style="position:absolute; top:-1000px" id='simpanData'>
<script>
$(document).ready(function(){
	$('select#access').on('change', function(){
		var access = $( "#access option:selected" ).val();
		console.log(access);
		var link = access=="app"?'admin/dashboard[show:app]':access=="self"?'':access=="module"?'admin/module[show2]':"";
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
