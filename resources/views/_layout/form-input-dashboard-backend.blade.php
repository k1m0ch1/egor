<label for="name">Name</label><br/>
<input type="text" name="name" id="name" value="{{ $nama }}" class="text ui-widget-content ui-corner-all"><br/>
<label for="href">Link Redirect</label><br/>
<input type="text" name="href" id="href" value="{{ $redirect }}" class="text ui-widget-content ui-corner-all"><br/>
<label for="image">Image</label>
<select class="image-picker show-html" id='image'>
                      @for($a=0;$a<sizeOf($files);$a++)
                        <?php $filename = explode( '/', $files[$a]); ?>
                        <option data-img-src="{{ asset('assets/img/uploaded') }}/{{ $filename[10] }}" value="{{ $filename[10] }}">  {{ $filename[10] }}  </option>
                      @endfor
</select><br/>
<input type='hidden' id='idnyah' value='{{ $id }}' />
<br/>
<input type="submit" tabindex="-1" style="position:absolute; top:-1000px">