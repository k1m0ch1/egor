<div class="form-group">
		<label for="name" style="padding-top: 10px;">Name</label>
		<input type="text" name="name" id="name" value="{{ $rS[0]->name }}" class="form-control">
		<label for="route" style="padding-top: 10px;">Routing</label>
		<input type="text" name="route" id="route" value="{{ $rS[0]->route }}" class="form-control">
		<label for="description" style="padding-top: 10px;">Description</label>
		<textarea id="description" class="form-control" cols=3 rows=4>{{ $rS[0]->description }}</textarea>
	</div>
<input type='hidden' id='id' value='{{ $rS[0]->id }}' />
<input type="submit" tabindex="-1" style="position:absolute; top:-1000px" id='simpanData'>
