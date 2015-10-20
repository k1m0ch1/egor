<div class='col-md-6'>
	<div class="form-group">
		<label for="name">Name</label><br/>
		<input type="text" name="name" id="name" value="{{ $name }}" class="form-control"><br/>

		<label for="email">Email</label><br/>
		<input type="text" name="email" id="email" value="{{ $email }}" class="form-control"><br/>

		<label for="name">Phone</label><br/>
		<input type="text" name="phone" id="phone" value="{{ $phone }}" class="form-control"><br/>
	</div>
</div>
<div class='col-md-6'>
	<div class="form-group">
		<label for="name">Jabatan</label><br/>
		<input type="text" name="department" id="department" value="{{ $department }}" class="form-control"><br/>

		@if($idnyah=='xxx')
			<label for="password">Password</label>
			<input type="password" name="password" id="password" class="form-control"><br/>
			<label for="Upassword">Ulangi Password</label>
			<input type="password" name="Upassword" id="Upassword" class="form-control"><br/>
		@else
			<label for="avatar">Avatar</label><br/>
			<input type='file' name='avatar' id='fileUpload' class="form-control"/>
			<p class="help-block">Kosongkan jika tidak ingin merubah</p>

			<label for="role">Role</label><br/>
			@foreach($resultRole as $rS)
				<input type="radio" id="roles" name="roles" value="{{$rS->id}}" > {{$rS->name}}
			@endforeach

			<input type='hidden' id='idnyah' value='{{ $idnyah }}' />
		@endif

	</div>
</div>
@if($idnyah=='xxx')
	<div class='col-md-12'>
		<div class="form-group">
			<label for="avatar">Avatar</label><br/>
			<input type='file' name='avatar' id='fileUpload' class="form-control"/>
			<p class="help-block">Kosongkan jika tidak ingin merubah</p>

			<label for="role">Role</label><br/>
			@foreach($resultRole as $rS)
				<input type="radio" id="roles" name="roles" value="{{$rS->id}}" > {{$rS->name}}
			@endforeach

			<input type='hidden' id='idnyah' value='{{ $idnyah }}' />
		</div>
	</div>
@endif

<input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
