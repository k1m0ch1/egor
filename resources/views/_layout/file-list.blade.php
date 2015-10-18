@if($files!=null)
	<select class="image-picker show-html" id="{{ $idSelector }}">
		@for($a=0;$a<sizeOf($files);$a++)
			<?php $filename = explode( '/', $files[$a]); ?>
			<?php $sizeFilename = sizeOf($filename); ?>
			<option data-img-src="{{ asset($dir) }}/{{ $filename[$sizeFilename-1] }}" value="{{ $filename[$sizeFilename-1] }}">  {{ $filename[$sizeFilename-1] }}  </option>
		@endfor
	</select>
@endif