@include('_layout.header-frontend')
<div class="page-wrapper">
<header class="header-egor">
	<div class="row">
		<div class="large-12 columns text-center">
			<h1 id="header-egor-header"></h1>
		</div>
	</div>
</header>
	<div class="row">
		<div class="large-12 columns">
			<ul class="small-block-grid-3" id="menu-wrapper">
				@for($i = 0; $i<=5; $i++)
					<li>
					<img src="holder.js/300x300" alt="">
					<a href="">tes</a>
					</li>
				@endfor
			</ul>
		</div>
	</div>
<footer class="footer-egor">
	<div class="footer-egor-content">
		<div class="row">
			<div class="large-3 columns"></div>
			<div class="large-3 columns"></div>
			<div class="large-3 columns"></div>
			<div class="large-3 columns"></div>
		</div>
	</div>
	<div class="footer-egor-copyright">
		<div class="row">
			<div class="large-12 columns text-center">
				<p>&copy; {{date('Y')}} - <span id="footer-copyright-text"></span></p>
			</div>
		</div>
	</div>
</footer>
</div>
<script type="text/javascript" src=""></script>
@include('_layout.footer-frontend')