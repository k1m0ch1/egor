@include('_layout.header-frontend')
		<!--[if lt IE 8]>
			<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
		<![endif]-->

		<!-- Add your site or application content here -->
		<div class="divider"></div>
		<div id="main-content">
			<div class="main-menu">
				<div class="row">
					<div class="large-12 columns">
						<ul class="small-block-grid-{{$h or '3'}}">
							@foreach($datanyah as $menu)
								<li>
									<a href="{{$menu->redirect or '/'}}" class="image-button">
									<img src="{{asset('assets/img/uploaded')}}/{{$menu->image}}" alt="">
									<p><span>{{$menu->nama}}</span></p>
								</a>
								</li>
							@endforeach
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="divider"></div>

@include('_layout.footer-frontend')