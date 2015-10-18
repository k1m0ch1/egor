@if(isset($files))
	<select class="image-picker show-html" id="{{ $idSelector }}">
		@foreach($files as $key => $f)
			<?php $filename = explode( '/', $f); ?>
			<?php $sizeFilename = sizeOf($filename); ?>
			@if($settings == $filename[$sizeFilename-1])
				<option data-img-src="{{ asset($dir) }}/{{ $filename[$sizeFilename-1] }}" value="{{ $filename[$sizeFilename-1] }}" selected="selected">  {{ $filename[$sizeFilename-1] }}  </option>
			@else
				<option data-img-src="{{ asset($dir) }}/{{ $filename[$sizeFilename-1] }}" value="{{ $filename[$sizeFilename-1] }}">  {{ $filename[$sizeFilename-1] }}  </option>
			@endif
		@endforeach
	</select>
@endif