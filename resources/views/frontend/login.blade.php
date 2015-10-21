@include('_layout.header-frontend')
	<div class="divider main">
		<div class="row">
			<div class="large-8 medium-8 small-12 columns">
				<h2>PORTAL LOGIN SINGLE SIGN ON 
				KEMENTRIAN ESDM</h2>
				<hr/>
				<div class="row main-url large-collapse">
					<div class="large-3 medium-6 small-12 columns">
						<p><img src="{{ asset('assets/img/share.png') }}" alt="">Secure</p>
					</div>
					<div class="large-3 medium-6 small-12 columns">
						<p><img src="{{ asset('assets/img/windcatcher.png') }}" alt="">Reliable</p>
					</div>
					<div class="large-3 medium-6 small-12 columns">
						<p><img src="{{ asset('assets/img/flag.png') }}" alt="">Transparent</p>
					</div>
				</div>
			</div>
			<div class="large-4 medium-4 small-12 columns">
				<div class="form-group form-egor">
					<div class="form-header">
						<p class="text-center"><i class="fa fa-lock"> </i>  Access Your Account</p>
					</div>
					<form action="{{route('users.login.post')}}" method="POST">
						{!! csrf_field() !!}
						<input type="text" placeholder="Username" name="username">
						<input type="password" placeholder="Password" name="password">
						<div class="form-footer">
							<div class="row">
								<div class="large-6 medium-12 small-6 columns">
									<input type="checkbox"> <small>Remember Me</small>
								</div>
								<div class="large-6 medium-12 small-6 columns">
									<button class="tiny">Log In</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

@include('_layout.footer-frontend') 