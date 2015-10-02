@include('_layout.header-frontend')

<div id="main" class="content">
	<div class="row">
			<div class="large-6 large-offset-3 columns">
								
				<div class="panel">
					<form action="{{route('users.login.post')}}" method="POST">
					{!! csrf_field() !!}
					<label for="username">Username</label>
					<input type="text" name="username" id="username">
					<label for="password">Password</label>
					<input type="password" name="password" id="password">
					<button class="small">Submit</button>
				</form>
				</div>

			</div>
		</div>	
</div>

@include('_layout.footer-frontend') 