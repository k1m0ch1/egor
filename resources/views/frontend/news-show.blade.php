@include('_layout.header-news')
		<!--[if lt IE 8]>
			<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
		<![endif]-->

		<!-- Add your site or application content here -->

	<div class="row" style="margin-top: 30px;">
		<div class="large-4 columns">
			<a href="{{--route('news.index')--}}" class="button tiny alert" onclick="window.history.back();"><i class="fa fa-arrow-left" ></i></a>
			<span class="label success right" style="padding:10px; font-size:1.5em;">{{$result->category or "-"}}</span>
			<div class="row">
				<div class="large-7 large-offset-5 columns">
					<p class="right text-right">Oleh {{$result->getAuthor()}} {{$result->formalTime()}}</p>
				</div>
			</div>
		</div>
		<div class="large-8 columns">
			<h1 >{{$result->title or "-"}}</h1>
		</div>
	</div>
	<div class="row">
		<div class="large-12 columns text-center">
			<img src="{{asset(\App\Models\News::UPLOAD_PATH)}}/{{$result->image}}" data-src="holder.js/960x480?theme=sky" alt="" style="margin:40px 0;">
		</div>
	</div>
	<div class="row" style="margin-bottom: 40px;">
		<div class="large-8 columns large-offset-3">
			{!!$result->content or "-"!!}
		</div>
	</div>
	<div id="dialog-form-profile" title="Rubah Pengaturan Profile">
		<form id='form-profile' enctype="multipart/form-data" method='post' action='{{route("users[edit:save]")}}'>
		{!! csrf_field() !!}
			<fieldset id='formnyah-profile'>

			</fieldset>
		</form>
	</div>

@include('_layout.footer-frontend')
