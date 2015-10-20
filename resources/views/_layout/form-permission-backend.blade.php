<div class='col-md-6'>
	<div class="form-group">
		<label for="name" style="padding-top: 10px;">Name</label>
		<input type="text" name="name" id="name" value="{{ $rS[0]->name }}" class="form-control">
		<label for="displayName" style="padding-top: 10px;" style="padding-top: 3px;">Display Name</label>
		<input type="text" name="displayName" id="displayName" value="{{ $rS[0]->display_name}}" class="form-control">
		<label for="access" style="padding-top: 10px;">Rules</label>
			<select name="access" id="access">
					<option value="true" {{ $rS[0]->access=="true"?"selected":"" }}>Dapat</option>
					<option value="false" {{ $rS[0]->access=="false"?"selected":"" }}>Tidak Dapat</option>
			</select>
			<select name="action" id="action">
					<option value="show" {{ $rS[0]->action=="show"?"selected":"" }}>Melihat</option>
					<option value="add" {{ $rS[0]->action=="add"?"selected":"" }}>Menambah</option>
					<option value="edit" {{ $rS[0]->action=="edit"?"selected":"" }}>Merubah</option>
					<option value="delete" {{ $rS[0]->action=="delete"?"selected":"" }}>Menghapus</option>
			</select>
	</div>
</div>
<div class='col-md-6'>
	<div class="form-group">
		<label for="description">Description</label>
		<textarea id="description" class="form-control" cols=3 rows=6>{{ $rS[0]->description }}</textarea>
		<input type='hidden' id='id' value='{{ $rS[0]->id }}' />
	</div>
</div>
<input type="submit" tabindex="-1" style="position:absolute; top:-1000px" id='simpanData'>
