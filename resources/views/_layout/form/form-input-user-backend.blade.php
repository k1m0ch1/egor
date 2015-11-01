<div class='col-md-6'>
	<div class="form-group">
		<label for="nip">NIP</label><br/>
		<input type="text" name="nip" id="nip" value="{{ $nip or "-"}}" class="form-control"><br/>

		<label for="name">Name</label><br/>
		<input type="text" name="name" id="name" value="{{ $name or "-"}}" class="form-control"><br/>

		<label for="email">Email</label><br/>
		<input type="text" name="email" id="email" value="{{ $email or "-"}}" class="form-control"><br/>

		<label for="name">Phone</label><br/>
		<input type="text" name="phone" id="phone" value="{{ $phone or "-"}}" class="form-control"><br/>
	</div>
</div>
<div class='col-md-6'>
	<div class="form-group">
		<label for="name">Jabatan</label><br/>
		<input type="text" name="jabatan" id="jabatan" value="{{ $jabatan or "-"}}" class="form-control"><br/>

		@if($idnyah=='xxx')
			<label for="password">Password</label>
			<input type="password" name="password" id="password" class="form-control"><br/>
			<label for="Upassword">Ulangi Password</label>
			<input type="password" name="Upassword" id="Upassword" class="form-control"><br/>
		@else
			<label for="avatar">Avatar</label><br/>
			@if($avatar != "")
				<img src="{{asset(\App\Models\User::UPLOAD_PATH)}}/{{$avatar}}" alt="">
				<br/>
			@endif
			<input type='file' name='avatar' id='fileUpload' class="form-control"/>
			<p class="help-block">Kosongkan jika tidak ingin merubah</p>

			<label for="role">Role</label><br/>
			@foreach($resultRole as $rS)
				@if($rS->id == $roles->id)
				<input type="radio" id="roles" name="roles" value="{{$rS->id}}" checked> {{$rS->name}}
				@else
				<input type="radio" id="roles" name="roles" value="{{$rS->id}}" > {{$rS->name}}
				@endif
			@endforeach

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

		</div>
	</div>
@endif

<input type='hidden' id='idnyah' value='{{ $idnyah }}' />

<input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
