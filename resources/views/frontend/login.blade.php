@include('_layout.header-frontend')
<body class="login">
<header class="navbar navbar-inverse navbar-egor">
					<div class="container">
						<!-- Brand and toggle get grouped for better mobile display -->
						<div class="navbar-header">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<a class="navbar-brand" href="{{ asset('') }}"><span>{{ $bah }}</span></a>
						</div>

						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
							<ul class="nav navbar-nav">
								@foreach($result1 as $rS)
					<li><a href="">{{ $rS->name }}</a></li>
				@endforeach
							</ul>
							
							<ul class="nav navbar-nav navbar-right">
								<li><a href="{{ asset('') }}index.php/login">LOG IN</a></li>
								
							</ul>
						</div><!-- /.navbar-collapse -->
					</div><!-- /.container-fluid -->
				</header>
				<!--[if lt IE 8]>
						<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
				<![endif]-->

				<!-- Add your site or application content here -->
			 <div class="divider main">
				 <div class="container">
					 <div class="row">
						 <div class="col-lg-8">
							 <h1>Silahkan Login Terlebih dahulu untuk mempunyai hak akses merubah portal ini</h1>
							 <p style="margin-top:80px;"><small>@fowab</small></p>
							 <hr>
							 <!-- <div class="row main-url">
								 <div class="col-lg-3">
									 <p><img src="{{ asset('assets/img/share.png') }}" alt="">Excepteur</p>
								 </div>
								 <div class="col-lg-3">
									 <p><img src="{{ asset('assets/img/windcatcher.png') }}" alt="">Somos Libre</p>
								 </div>
								 <div class="col-lg-3">
									 <p><img src="{{ asset('assets/img/flag.png') }}" alt="">Anno Domini</p>
								 </div>
								 <div class="col-lg-3">
									 <p><img src="{{ asset('assets/img/flame.png') }}" alt="">Tala</p>
								 </div>
							 </div> -->
						 </div>
						 <div class="col-lg-4">
							 <div class="form-group form-egor">
								 <div class="form-header">
									 <i class="fa fa-lock"> Access Your Account</i>
								 </div>
								 <form action="{{route('users.login.post')}}" method="POST">
								 {!! csrf_field() !!}
								 <input type="username" class="form-control" placeholder="Username" name="username">
								 <input type="password" class="form-control" placeholder="Password" name="password">
								 <div class="form-footer">
									 <div class="row">
										 <div class="col-lg-6">
											 <input type="checkbox"> Remember Me
										 </div>
										 <div class="col-lg-6">
											 <button>Log In</button>
										 </div>
									 </div>
								 </div>
								 </form>
							 </div>
						 </div>
					 </div>
				 </div>
			 </div>
				
			 <div class="footer">
					 <div class="container">
					 
							 <div class="row copyright">
									 <div class="col-lg-12">
											 <p class="text-center">
													 Copyright &copy; 2015 - <a href="">Company Name</a>
											 </p>
									 </div>
							 </div>
					 </div>
			 </div>

@include('_layout.footer-frontend') 