@include('_layout.header-frontend')
	<div class="divider main" style='margin: 100px 0;'>
		<div class="row">
			<div class="large-8 medium-8 small-12 columns">
				<h2>BERITA TERBARU</h2>
				<hr/>
				<div class="row large-collapse">
					@foreach($result as $res)
						<div class="large-4 medium-6 small-12 row">
							<div class="large-3 medium-4 small-10 column">
								<img src="{{asset(\App\Models\News::UPLOAD_PATH)}}/{{$res->image or "-"}}" class="right" alt="" style="border-radius: 50%; width: 120px; height: 120px;" data-src="holder.js/70x50">
							</div>
							<div class="large-9 medium-3 small-10 column">
								<p><h4>{{$res->title or "-"}}</h4></p>
								<p>{{str_limit(strip_tags($res->content), 250)}}</p>
								<a href="{{asset('news')}}/{{$res->id}}" class="button tiny right" style="margin-top: 10px"><i class="fa fa-arrow-right"></i> Read More</a>
							</div>
						</div>
					@endforeach
				</div>
			</div>
			<div class="large-4 medium-4 small-12 columns">
				<div class="form-group form-egor">
					<div class="form-header">
						<p class="text-center"><i class="fa fa-lock"> </i> <a href="#">Login SSO here</a></p>
					</div>
				</div>
			</div>
		</div>
	</div>

@include('_layout.footer-frontend')
