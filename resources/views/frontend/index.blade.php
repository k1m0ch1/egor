@include('_layout.header-frontend')
<body class="index">
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
			  <a class="navbar-brand" href="index.html"><span>{{ $bah }}</span></a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			  <ul class="nav navbar-nav">
			  	@foreach($result1 as $rS)
					<li><a href="">{{ $rS->name }}</a></li>
				@endforeach
			  </ul>
			  
			  <ul class="nav navbar-nav navbar-right">
				<li><a href="login">LOG IN</a></li>
				
			  </ul>
			</div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		</header>
		<!--[if lt IE 8]>
			<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
		<![endif]-->

		<!-- Add your site or application content here -->
		<div class="divider"></div>
	   <div class="container main-menu">
		   
		   <div class="row">
			   <div class="col-lg-4 col-md-4 col-sm-12 text-center">
				   <a href="" class="image-button"><img src="{{ asset('assets/img/aplikasi-surat.png') }}" alt="">
					<span>Aplikasi Surat</span>
				   </a>
			   </div>
			   <div class="col-lg-4 col-md-4 col-sm-12 text-center">
				   <a href="" class="image-button"><img src="assets/img/perjalanan-dinas.png" alt="">
				   <span>Perjalanan Dinas</span>
				   </a>
			   </div>
			   <div class="col-lg-4 col-md-4 col-sm-12 text-center">
				   <a href="" class="image-button"><img src="assets/img/sistem-info-pegawai.png" alt="">
					<span>Sistem Info Pegawai</span>
				   </a>
			   </div>
		   </div>
	   </div>
		<div class="divider"></div>
		
	   <div class="footer">
		   <div class="container">
			   <div class="row copyright">
				   <div class="col-lg-12">
					   <p class="text-center">
						   Copyright &copy; 2015 - <a href="">{{ $bah }}</a>
					   </p>
				   </div>
			   </div>
		   </div>
	   </div>
	   @include('_layout.footer-frontend')