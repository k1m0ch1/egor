<div class='col-md-6'>
  <div id="form-group">
    <h3>Module Permission</h3>
    <?php $a=0; ?>
    @foreach($result as $rS)
      <input type="checkbox" id="modID-{{ $a++ }}" class="minimal" value="{{ $rS->id }}">{{ $rS->name }} <br/>
    @endforeach
   </div>
</div>
<div class='col-md-6'>
  <div id="form-group">
    <h3>Application Permission</h3>
    <?php $x=0; ?>
    @foreach($rSapps as $rS)
      <input type="checkbox" id="appID-{{$x++}}" class="minimal" value="{{ $rS->id }}">{{ $rS->nama }} <br/>
    @endforeach
   </div>
</div>
<input type='hidden' id='modCount' value="{{$a}}" />
<input type='hidden' id='appCount' value="{{$x}}" />
<input type='hidden' id='role_id' name='role_id' value="{{ $role_id }}" />
<input type="submit" tabindex="-1" style="position:absolute; top:-1000px" id='simpanData'>

<script>
$.ajax({
  url:  host + 'admin/permission[modelChecked]',
  type: 'GET',
  data: { role_id: $('#role_id').val() },
  dataType: 'html',
  success: function(data) {
    data = jQuery.parseJSON(data);
    for(var b=0;b<data.length;b++){
      for(var a=0;a<{{$a}};a++){
        //console.log(data[a]["action"] + "==" + $('#modID-' + b).val() + " is " + (data[a]["action"]==$('#modID-' + b).val()));
        if(data[b]["id"]==$('#modID-' + a).val()){
          $('#modID-' + a).prop('checked', true);
        }
      }
    }
  }
});

$.ajax({
  url:  host + 'admin/permission[appChecked]',
  type: 'GET',
  data: { role_id: $('#role_id').val() },
  dataType: 'html',
  success: function(data) {
    data = jQuery.parseJSON(data);
    for(var b=0;b<data.length;b++){
      for(var a=0;a<{{$x}};a++){
        //console.log(data[a]["action"] + "==" + $('#modID-' + b).val() + " is " + (data[a]["action"]==$('#modID-' + b).val()));
        if(data[b]["id"]==$('#appID-' + a).val()){
          $('#appID-' + a).prop('checked', true);
        }
      }
    }
  }
});
</script>
