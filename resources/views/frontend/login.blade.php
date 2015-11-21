@include('_layout.header-frontend2')
	<div class="divider main" style='margin: 50px 0; padding: 50px 0;min-height: 520px;'>
		<div class="row">
			<div class="large-8 medium-8 small-12 columns" >
				<h3 style='font-family: "Quicksand", "Helvetica Neue", "Helvetica", sans-serif;'>BERITA TERBARU</h3>
					@foreach($result as $res)
						<div class="large-12 medium-12 small-12 clearfix article" style="border:3px #B0B7D8 solid; background-color: white;">
							<div class="large-2 medium-4 small-12 column text-center" >
								<img src="{{asset(\App\Models\News::UPLOAD_PATH)}}/{{$res->image or "-"}}" alt="" style=" margin-top: 7px; border-radius: 50%; width: 85px; height: 85px;" data-src="holder.js/70x50">
							</div>
							<div class="large-7 medium-5 small-12 column" style="margin-top:10px;">
								<p style='color: black; font-size: 15px; font-family: "Quicksand", "Helvetica Neue", "Helvetica", sans-serif;'>
									<b>{{$res->title or "-"}}</b> <br/> {{str_limit(strip_tags($res->content), 60)}}
							</div>
							<div class="large-3 medium-4 small-12 column">
								<a href="{{asset('news')}}/{{$res->id}}" class="button tiny right" style="margin-top:30px;" ><i class="fa fa-arrow-right"></i> Read More</a></p>
								
							</div>
						</div>
					@endforeach
				<span class="button tiny center" style="margin-top: 15px;">Halaman</span>
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
			<div class="large-4 medium-4 small-12 columns text-center">
				<div class="wrapper-button show-for-medium-up" style="margin-top:75px;"></div>
				<div class="wrapper-button show-for-small-only" style="margin-top:50px;"></div>
					
					<div class="large-10 medium-10 small-10 columns large-offset-1">
						<a href="" style="background: #333;border: #F1EC7A 3px solid; border-radius:5px;display: block;padding: 20px;">
						<h3 class="text-center">
							<i class="fa fa-lock" style="font-size: 120px;"></i>
							<span style="display: block;color:#F1EC7A;">GO TO <br/>LOGIN PAGE</span>
														
						</h3>
					</a>
					</div>
					<!-- <button class="button split no-pip expand" style="padding:20px 0;background: #ED8C02;border-bottom:#E04C07 3px solid">Login SSO <span><i class="fa fa-caret-right"></i></button> -->

				<div class="wrapper-button show-for-small-only" style="margin-top:50px;"></div>
				<div class="wrapper-button show-for-medium-up" style="margin-top:75px;"></div>

			</div>
			<!-- <p align="center">
				Hati Hati penggunaan Username dan password menggunakan case sensitive
			</p> -->
			
		</div>
	</div>
@include('_layout.footer-frontend')