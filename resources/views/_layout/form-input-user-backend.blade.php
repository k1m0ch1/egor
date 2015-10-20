<div class="form-group">
	<label for="nip">NIP</label><br/>
	<input type="text" name="nip" id="nip" value="{{ $nip }}" class="form-control"><br/>

	<label for="name">Name</label><br/>
	<input type="text" name="name" id="name" value="{{ $name }}" class="form-control"><br/>

	<label for="email">Email</label><br/>
	<input type="text" name="email" id="email" value="{{ $email }}" class="form-control"><br/>

	<label for="name">Phone</label><br/>
	<input type="text" name="phone" id="phone" value="{{ $phone }}" class="form-control"><br/>

	<label for="name">Department</label><br/>
	<input type="text" name="department" id="department" value="{{ $department }}" class="form-control"><br/>

	<label for="avatar">Avatar</label><br/>
	<input type='file' name='avatar' id='fileUpload' class="form-control"/>
	<p class="help-block">Kosongkan jika tidak ingin merubah</p>

	<label for="role">Role</label><br/>
	@foreach($resultRole as $rS)
		<input type="radio" id="roles" name="roles" value="{{$rS->id}}" > {{$rS->name}}<br/>
	@endforeach

	<label for="image">Password</label>
	<input type="password" name="password" id="password" class="form-control"><br/>
	<label for="image">Ulangi Password</label>
	<input type="password" name="Upassword" id="Upassword" class="form-control"><br/>
	<input type='hidden' id='idnyah' value='{{ $idnyah }}' />
</div>
<input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
