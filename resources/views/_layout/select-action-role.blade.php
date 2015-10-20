<select name="action" id="action">
  @foreach($hasil as $rS)
    <option value="{{ $rS->id }}">{{ $access=="app"?$rS->nama:"" }}</option>
  @endforeach
</select>
