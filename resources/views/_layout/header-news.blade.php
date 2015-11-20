<!doctype html>
<html class="no-js" lang="">
	<head>
		@if(substr($logo,-1)!="/")
			<link rel="icon" href="{{ $logo or '' }}">
		@endif
		<meta charset="utf-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<title>{{$bah or 'Title'}}</title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="apple-touch-icon" href="apple-touch-icon.png">
		<!-- Place favicon.ico in the root directory -->
		<link rel="stylesheet" href="{{ asset('assets/css/frontend.css') }}">
		<link href='https://fonts.googleapis.com/css?family=Quicksand:400,700,300' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="{{asset('assets/vendor/jquery-ui/themes/smoothness/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="http://egor.app/assets/vendor/AdminLTE/dist/css/AdminLTE.min.css">
	</head>
<body>
<div class="contain-to-grid">
	<nav class="top-bar" data-topbar role="navigation">
  <ul class="title-area">
	<li class="name">
	  <h1><a href="{{url('/')}}">{{$bah or 'Title'}}</a></h1>
	</li>
	 <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
	<li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
  </ul>

  <section class="top-bar-section">

	<!-- Left Nav Section -->
	<ul class="left">
		@foreach($result1 as $rS)
			<li><a href="{{$rS->redirect}}">{{$rS->name or '-'}}</a></li>
		@endforeach
	</ul>
	<!-- Right Nav Section -->
	<ul class="right">
			<li>
				<a href="{{url('/')}}"><i class="fa fa-home"></i> HOME</a>
			</li>
			<li>
				<a href="{{url('news')}}"><i class="fa fa-newspaper-o"></i> NEWS</a>
			</li>
			<li class="has-dropdown">
				<a href="#" ><i class="fa fa-user"></i> USER CONTROL</a>
				<ul class="dropdown">
					<li>
						@if(\Auth::check())
							<a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> DASHBOARD</a>
						@else
							<a href="{{url('login')}}"><i class="fa fa-sign-in"></i> SIGN IN</a>
						@endif
					</li>
					@if(\Auth::check())
					<li>
						<a href="#profile" id='userProfile'><i class="fa fa-user"></i> USER PROFILE</a>
					</li>
						<li>
							<a href="{{url('logout')}}"><i class="fa fa-sign-out"></i> LOGOUT</a>
						</li>
					@endif
				</ul>
			</li>
			<!-- <li ><a href="{{url('login_sso')}}"><i class="fa fa-sign-in"></i> SIGN IN</a></li> -->
	</ul>
	<!-- <script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js') }}"></script>
	<script>
		$(document).ready(function(){
			$('ul.child').hide();
			$('li.parent').click(function() {
			$('ul.child').slideUp();
				$(this).find('ul.child').slideToggle();
			});
		});
	</script> -->
  </section>
</nav>
</div>
