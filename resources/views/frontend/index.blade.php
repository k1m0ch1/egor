@include('_layout.header-frontend')
		<!--[if lt IE 8]>
			<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
		<![endif]-->

		<!-- Add your site or application content here -->
		@if(count($datanyah)!=0)
			<div class="divider"></div>
		@endif
		<div id="main-content">
			<div class="main-menu">
				<div class="row">
					<div class="large-12 medium-12 small-12 columns">
						<ul class="small-block-grid-1 medium-block-grid-{{$h or '3'}}">
							@foreach($datanyah as $menu)
  								<li>
  									<a href="{{$menu->redirect or '/'}}" class="image-button">
  									<img src="{{asset('/uploads/menu/')}}/{{ $menu->image or '' }}" data-src="holder.js/150x150" alt="">
  									<p><span>{{$menu->nama or ''}}</span></p>
  								</a>
  								</li>
							@endforeach
						</ul>
					</div>
				</div>
			</div>
		</div>
		@if(count($datanyah)!=0)
			<div class="divider"></div>
		@endif

</div>
@include('_layout.footer-frontend')
<div id="dialog-form-profile" title="Rubah Pengaturan Profile">
	<form id='form-profile' enctype="multipart/form-data" method='post' action='{{route("users[edit:save]")}}'>
	{!! csrf_field() !!}
		<fieldset id='formnyah-profile'>

		</fieldset>
	</form>
</div>
