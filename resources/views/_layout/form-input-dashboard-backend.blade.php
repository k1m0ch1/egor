<div class="form-group">
	<label for="name">Name</label>
	<input type="text" name="name" id="name" value="{{ $nama }}" class="form-control">
</div>
<div class="form-group">
	<label for="href">Link Redirect</label>
	<input type="text" name="href" id="href" value="{{ $redirect }}" class="form-control">
</div>
<div class="form-group">
	<input type="radio" name="target" value="_blank" {{ $mode=="_blank"?'checked="checked"':"" }}> Tab Baru
	<input type="radio" name="target" value="_self" {{ $mode=="_self"?'checked="checked"':"" }}> Dihalaman itu sendiri
</div>

<div class="form-group">
	<label for="href">Public Key</label>
	<input type="text" name="puKey" id="puKey" value="{{$puKey}}" class="form-control">
</div>
<div class="form-group">
	<label for="href">Private Key</label>
	<input type="text" name="prKey" id="prKey" value="{{$prKey}}" class="form-control">
</div>

<div class="form-group">
	<label for="href">Image</label>
	<input type='file' name='image' id='fileUpload' class="form-control"/>
	<p class="help-block">Kosongkan jika tidak ingin merubah</p>
	<input type='hidden' id='idnyah' value='{{ $id }}' />
	<input type='hidden' id='parent_id' value='{{ $parent_id }}' />
</div>
<input type="submit" tabindex="-1" style="position:absolute; top:-1000px" >
