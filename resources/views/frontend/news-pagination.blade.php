<div class="row">
	<div class="large-12 columns text-center">
		<ul class="pagination">
			@for($i = 1; $i<=$count; $i++)
				<li><a href="{{route('news.index')}}?page={{$i}}">{{$i}}</a></li>
			@endfor
		</ul>
	</div>
</div>