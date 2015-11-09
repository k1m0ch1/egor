		<div class="footer">
			   <div class="row">
				   <div class="col-lg-12">
						 @if($logo!="")
						  <center><img src="{{ $logo or '' }}" style="align: center; height: 100px; width: 100px; margin-top:-40px;"/></center>
						 @endif
					   <p class="text-center">
						   {{$footer or '-'}} - <a href="{{url('/')}}">{{ $bah or 'Title' }}</a>
					   </p>
				   </div>
		   </div>
	   </div>

		<script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js') }}"></script>
		<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.3.min.js"><\/script>')</script>
		<script src="{{ asset('assets/vendor/foundation/js/foundation.min.js') }}"></script>
		<script type="text/javascript" src="{{asset('assets/vendor/holderjs/holder.min.js')}}"></script>
		<script type="text/javascript" src="{{ asset('assets/vendor/SmoothScrollWheel/dist/jquery.SmoothScrollWheel.min.js') }}"></script>
		<script type="text/javascript">
			$(document).foundation();
		  $(document).SmoothScrollWheel({
			defaultSpeed: 500,
			 defaultAnimationTime: 1000
		  });
		</script>

		@if(\Auth::check())
			<script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js') }}"></script>
			<script src="{{ asset('assets/vendor/jquery-ui/jquery-ui.min.js') }}"></script>
			<script>
			$(document).ready(function(){
				$('#dialog-form-profile').hide();
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

		<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
	   <!--  <script>
			(function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
			function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
			e=o.createElement(i);r=o.getElementsByTagName(i)[0];
			e.src='https://www.google-analytics.com/analytics.js';
			r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
			ga('create','UA-XXXXX-X','auto');ga('send','pageview');
		</script> -->
	</body>
</html>
