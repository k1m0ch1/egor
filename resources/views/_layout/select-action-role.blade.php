<select name="action" id="action" class='form-control'>
  @foreach($result as $rS)
    <option value="{{ $rS->id }}">{{ $access=="app"?$rS->nama:$rS->name }}</option>
  @endforeach
</select>
