@include('_layout.header-frontend')
	<div class="divider main" style='margin: 100px 0;'>
		<div class="row">
			<div class="large-8 medium-8 small-12 columns">
				<h2>BERITA TERBARU</h2>
				<hr/>
				<div class="row large-collapse">
					@foreach($result as $res)
						<div class="large-4 medium-6 small-12 row" style="border-style: ridge; ">
							<div class="large-3 medium-4 small-10 column" style="margin-top:10px;">
								<img src="{{asset(\App\Models\News::UPLOAD_PATH)}}/{{$res->image or "-"}}" class="right" alt="" style="border-radius: 50%; width: 120px; height: 120px;" data-src="holder.js/70x50">
							</div>
							<div class="large-9 medium-3 small-10 column" style="margin-top:10px;">
								<p><h4>{{$res->title or "-"}}</h4></p>
								<p>{{str_limit(strip_tags($res->content), 250)}}</p>
								<a href="{{asset('news')}}/{{$res->id}}" class="button tiny right"><i class="fa fa-arrow-right"></i> Read More</a>
							</div>
						</div>
					@endforeach
				</div>
				<span class="button tiny center">Halaman</span>
				@for($i = 1; $i<=$count; $i++)
					<a href="{{route('users.login.get')}}?page={{$i}}"
							@if($i==$page)
								style="font-size: 15px;"
							@else
								style="padding-top: 10px; font-size: 10px; "
							@endif
							class="button tiny center" >{{$i}}</a></li>
				@endfor

			</div>
			<!-- <p align="center">
				Hati Hati penggunaan Username dan password menggunakan case sensitive
			</p> -->
			<div class="large-4 medium-4 small-12 columns">
				<div class="form-group form-egor">
					<div class="form-header" style="width: 330px; height: 200px; position: fixed; top: 50%;  margin-left: 20px;">
						<p class="text-center" style="font-size: 50px;"><i class="fa fa-lock"> </i>  Login SSO Here</p>
					</div>
					<!-- <form action="{{route('users.login.post')}}" method="POST">
						{!! csrf_field() !!}
						<input type="text" placeholder="Username" name="username">
						<input type="password" placeholder="Password" name="password">
						<div class="form-footer">
							<div class="row">
								<div class="large-6 medium-12 small-6 columns">
									<button class="tiny">Log In</button>
								</div>
							</div>
						</div>
					</form> -->
				</div>
			</div>
		</div>
	</div>

@include('_layout.footer-frontend')
