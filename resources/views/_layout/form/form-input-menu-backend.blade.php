<div class="form-group">
	<label for="name">Name</label>
	<input type="text" name="name" id="name" value="{{ $name }}" class="form-control">
</div>
<div class="form-group">
	<label for="href">Link Redirect</label>
	<input type="text" name="href" id="href" value="{{ $redirect }}" class="form-control">
	<input type='hidden' id='idnyah' value='{{ $id }}' />
	<input type='hidden' id='parent_id' value='{{$parent_id}}' />
</div>
<input type="submit" tabindex="-1" style="position:absolute; top:-1000px" id='simpanData'>