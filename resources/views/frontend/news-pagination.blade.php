<div class="row">
	<div class="large-12 columns text-center" style="padding-bottom: 20px;">
		<ul class="pagination" style="display: inline-block;">
				<li><a href=# style="font-size: 20px; padding-top: 10px;">HALAMAN </a></li>
			@for($i = 1; $i<=$count; $i++)
				<li><a href="{{route('news.index')}}?page={{$i}}"
						@if($i==$page)
							style="font-size: 35px;"
						@else
							style="padding-top: 10px; font-size: 23px; "
						@endif
						>{{$i}}</a></li>
			@endfor
		</ul>
	</div>
</div>
