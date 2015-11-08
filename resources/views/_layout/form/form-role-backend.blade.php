	<div class="form-group">
		<label for="name">Name</label>
		<input type="text" name="name" id="name" value="{{ $rS[0]->name }}" class="form-control">
		<label for="displayName">Display Name</label>
		<input type="text" name="displayName" id="displayName" value="{{ $rS[0]->display_name}}" class="form-control">
		<label for="description">Description</label>
		<textarea id="description" class="form-control" cols=3 rows=5>{{ $rS[0]->description }}</textarea>
	</div>
</div>
<input type="submit" tabindex="-1" style="position:absolute; top:-1000px" id='simpanData'>
<input type='hidden' id='id' value='{{ $rS[0]->id }}' />
