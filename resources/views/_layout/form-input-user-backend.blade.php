<div class="form-group">
	<label for="name">Name</label><br/>
	<input type="text" name="name" id="name" value="{{ $name }}" class="form-control"><br/>

	<label for="email">Email</label><br/>
	<input type="text" name="email" id="email" value="{{ $email }}" class="form-control"><br/>

	<label for="image">Password</label>
	<input type="password" name="password" id="password" class="form-control"><br/>
	kosongkan jika tidak akan diubah
	<input type='hidden' id='idnyah' value='{{ $idnyah }}' />
</div>
<input type="submit" tabindex="-1" style="position:absolute; top:-1000px">