@include('_layout.header-news')
		<!--[if lt IE 8]>
			<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
		<![endif]-->

		<!-- Add your site or application content here -->
	
	<div class="row">
		<div class="large-8 columns large-offset-2">
			<div class="row" style="margin-top: 30px;">
		@foreach($result as $res)
			<article id="article-{{$res->id}}" style="margin-bottom: 60px;border-bottom: 5px #EEE solid;">
				<div class="row">
					<div class="large-12 columns">
						<img src="{{asset(\App\Models\News::UPLOAD_PATH)}}/{{$res->image or "-"}}" data-src="holder.js/480x240" alt="">
						<span class="label success" style="position: absolute;top:300px;left:40px">{{$res->category}}</span>
					</div>
				</div>
				<div class="row">
					<div class="large-12 columns" >
						<div class="article-body" style="border:1px #CCC solid;padding:10px;">
							<h3>{{$res->title or "-"}}</h3>
							<p style="color:#CCC">{{$res->formalTime()}} by {{$res->getAuthor()}}</p>
							{!!$res->excerpt()!!}
							<!-- <a href="{{route('news.show', $res->id)}}" class="button tiny right" style="margin-top: 10px"><i class="fa fa-arrow-right"></i> Read More</a>

 -->						</div>
					</div>
				</div>
				</div>
			</article>
		@endforeach
	</div>
		</div>
	</div>

@include('frontend.news-pagination')

@include('_layout.footer-frontend')
