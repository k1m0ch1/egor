<div class='col-md-6'>
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
		<label for="puKey">Public Key</label>
		<input type="text" name="puKey" id="puKey" value="{{$puKey}}" class="form-control">
	</div>
	<div class="form-group">
		<label for="prKey">Private Key</label>
		<input type="text" name="prKey" id="prKey" value="{{$prKey}}" class="form-control">
	</div>
</div>
<div class='col-md-6'>
	<div class="form-group">
		<label for="puKey">Query</label>
		<input type="text" name="puKey" id="query" value="{{$query}}" class="form-control">
	</div>
	<div class="form-group">
		<label for="prKey">DB Host</label>
		<input type="text" name="prKey" id="dbhost" value="{{$dbhost}}" class="form-control">
	</div>
	<div class="form-group">
		<label for="puKey">DB User</label>
		<input type="text" name="puKey" id="dbuser" value="{{$dbuser}}" class="form-control">
	</div>
	<div class="form-group">
		<label for="prKey">DB Pass</label>
		<input type="text" name="prKey" id="dbpass" value="{{$dbpass}}" class="form-control">
	</div>

</div>
<div class='col-md-12'>
	<div class="form-group">
		<label for="fileUpload">Image</label><br/>
		@if($avatar != '')
			<img src="{{asset(\App\Models\ParentFrontpage::UPLOAD_PATH)}}/{{$avatar}}" alt="">
		@endif
		<input type='file' name='image' id='fileUpload' class="form-control"/>
		<p class="help-block">Kosongkan jika tidak ingin merubah</p>
		<input type='hidden' id='idnyah' value='{{ $id }}' />
		<input type='hidden' id='parent_id' value='{{ $parent_id }}' />
	</div>
	<input type="submit" tabindex="-1" style="position:absolute; top:-1000px" >
</div>
