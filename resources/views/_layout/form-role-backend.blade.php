<div class="form-group">
	<label for="name">Name</label>
	<input type="text" name="name" id="name" value="{{ $rS[0]->name }}" class="form-control">
	<label for="displayName">Display Name</label>
	<input type="text" name="displayName" id="displayName" value="{{ $rS[0]->display_name}}" class="form-control">
	<label for="description">Description</label>
	<input type="text" name="description" id="description" value="{{ $rS[0]->description }}" class="form-control">
	<input type='hidden' id='id' value='{{ $rS[0]->id }}' />
</div>
<input type="submit" tabindex="-1" style="position:absolute; top:-1000px" id='simpanData'>