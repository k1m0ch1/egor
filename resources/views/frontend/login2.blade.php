<html>
<body>
<form action="{{route('users.login.post')}}" method="POST">
						{!! csrf_field() !!}
						<input type="text" placeholder="Username" name="username">
						<input type="password" placeholder="Password" name="password">
						<div class="form-footer">
							<div class="row">
								<div class="large-6 medium-12 small-6 columns">
									<button class="tiny">Log In</button>
								</div>
							</div>
						</div>
					</form>
</body>
</html>
