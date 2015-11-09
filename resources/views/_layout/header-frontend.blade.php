<!doctype html>
<html class="no-js" lang="">
	<head>
		@if($logo!="")
			<link rel="icon" href="{{ $logo or '' }}">
		@endif
		<meta charset="utf-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<title>{{$bah or 'Title'}}</title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- Place favicon.ico in the root directory -->
		<link rel="stylesheet" href="{{ asset('assets/css/frontend.css') }}">
		<link href='https://fonts.googleapis.com/css?family=Quicksand:400,700,300' rel='stylesheet' type='text/css'>
		<style>
		html {
			background: url('{{$bg}}') no-repeat center center fixed;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
			}
		</style>
	</head>
@if(isset($bg))
<body class="index">
@else
<body class="index">
@endif
<div class="contain-to-grid">
	<nav class="top-bar" data-topbar role="navigation">
	@if($logo!="")
		<img src="{{ $logo or '' }}" style="float: left; height: 50px; width: 50px; margin-top: 5px; margin-right: -15px;"/>
	@endif
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
	  <li >
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
	  <!-- <li ><a href="{{url('login_sso')}}"><i class="fa fa-sign-in"></i> SIGN IN</a></li> -->
		</ul>
	  </li>
	</ul>

  </section>
	@if(\Auth::check())
		<script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js') }}"></script>
		<script src="{{ asset('assets/vendor/jquery-ui/jquery-ui.min.js') }}"></script>
		<script>
		$(document).ready(function(){
			var dialog;
			dialog = $( "#dialog-form-profile" ).dialog({
				autoOpen: false,
				height: 420,
				width: 700,
				modal: true,
				draggable: false,
				resizable: false,
				buttons: {
					"Simpan": simpan,
					Cancel: function() {
						dialog.dialog( "close" );
					}
				},
				close: function() {
					form[0].reset();
				}
			});

			form = dialog.find( "form-profile" ).on( "submit", function( event ) {
				 event.preventDefault();
				 simpan();
			 });

			$('#userProfile').on('click', function(){
					var idnyah = {{ \Auth::user()->id }};
							dialog.dialog( "open" );
							$.ajax({
								url:  host + 'admin/users[edit:show]',
								type: 'GET',
								data: { id: idnyah },
								dataType: 'html',
								success: function(data) {
									$('#formnyah-profile').html(data);
								}
						 });
			});

			function simpan(){
				var a = $('#dialog-form form input#name').val();
				var b = $('#dialog-form form input#email').val();
				var d = $('#dialog-form form input#idnyah').val();
				var e = $("#dialog-form form input[type=radio][name=roles]:checked").val();
				var f = d=="xxx"?$('#dialog-form form input#password').val():"";
				var g = $('#dialog-form form input#phone').val();
				var h = $('#dialog-form form input#jabatan').val();
				var i = $('#dialog-form form input#Upassword').val();
				var j = $('#dialog-form form input#nip').val();

				var fd = new FormData();
				fd.append("name", a);
				fd.append("email", b);
				fd.append("avatar", $('#fileUpload').prop('files')[0]);
				if(d != 'xxx'){
					fd.append("id", d);
				}
				fd.append("roles", e);
				fd.append("password", f);
				fd.append("password_confirmation", i);
				fd.append("as", "add");
				fd.append("phone", g);
				fd.append("department", h);
				fd.append("nip", j);
				$.ajax({
								url: host+ 'admin/users[edit:save]',
								type: 'POST',
								processData: false,
								contentType: false,
								data: fd,
								dataType: 'html',
								success: function(data) {
									$.ajax({
									});
								}
						 });
				dialog.dialog("close");
			}
		});
		</script>
	@endif

</nav>
</div>
