		<div class="footer">
		   <div class="container">
			   <div class="row copyright">
				   <div class="col-lg-12">
					   <p class="text-center">
						   Copyright &copy; 2015 - <a href="{{url('/')}}">{{ $bah or 'Title' }}</a>
					   </p>
				   </div>
			   </div>
		   </div>
	   </div>

		<script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js') }}"></script>
		<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.3.min.js"><\/script>')</script>
		<script src="{{ asset('assets/vendor/bootstrap-sass/assets/javascripts/bootstrap.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('assets/vendor/SmoothScrollWheel/dist/jquery.SmoothScrollWheel.min.js') }}"></script>
		<script type="text/javascript">
		  $(document).SmoothScrollWheel({
			defaultSpeed: 500,
			 defaultAnimationTime: 1000
		  });
		</script>
		<script src="{{ asset('assets/js/dashboard.js') }}"></script>

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