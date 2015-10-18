@include('_layout.header-frontend')
	<div class="divider main">
		<div class="row">
			<div class="large-8 medium-8 small-12 columns">
				<h1>Halaman Login</h1>
				<hr/>
				<div class="row main-url large-collapse">
					<div class="large-3 medium-6 small-12 columns">
						<p><img src="{{ asset('assets/img/share.png') }}" alt="">Excepteur</p>
					</div>
					<div class="large-3 medium-6 small-12 columns">
						<p><img src="{{ asset('assets/img/windcatcher.png') }}" alt="">Somos Libre</p>
					</div>
					<div class="large-3 medium-6 small-12 columns">
						<p><img src="{{ asset('assets/img/flag.png') }}" alt="">Anno Domini</p>
					</div>
					<div class="large-3 medium-6 small-12 columns">
						<p><img src="{{ asset('assets/img/flame.png') }}" alt="">Tala</p>
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
				<!--[if lt IE 8]>
						<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
				<![endif]-->

				<!-- Add your site or application content here -->
@include('_layout.footer-frontend') 