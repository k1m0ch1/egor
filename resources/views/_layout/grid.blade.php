@for($i = 1; $i<=$w; $i++)
  <tr>
  @for($j = 1; $j<=$h; $j++)
    <td class='pindah' style='padding-left: 10px; padding-bottom: 10px;'>
        <?php $img[$a][3] = isset($img[$a][3])?$img[$a][3]:'x'; ?>
        <?php $img[$a][0] = isset($img[$a][0])?$img[$a][0]:'Baru'; ?>
        <?php $img[$a][1] = isset($img[$a][1])?$img[$a][1]:'x'; ?>
        <?php $img[$a][2] = isset($img[$a][2])?$img[$a][2]:'#'; ?>
        <?php $img[$a][4] = isset($img[$a][4])?$img[$a][4]:'x'; ?>
        <?php $checkFile = get_headers(asset(\App\Models\ParentFrontpage::UPLOAD_PATH . $img[$a][3] )); ?>
        @if ($checkFile[0] != 'HTTP/1.1 404 Not Found')
            <img class="img-thumbnail" src="{{ asset(\App\Models\ParentFrontpage::UPLOAD_PATH) }}/{{ $img[$a][3] }}" alt="" id="img-thumbnail-{{$img[$a][4]}}" />
        @elseif ($img[$a][3] == 'holder.js/180x180')
            <img data-src="{{ $img[$a][3] }}" class="img-thumbnail" alt="" id="{{$img[$a][4]}}" />
        @else
          <img id='gambar' class="img-thumbnail" src="{{ asset('assets/img') }}/addimage.png" alt="" />
        @endif
        <a href="{{ $img[$a][2] }}">{{ $img[$a][0] }} </a>
        <div id='minimenu' style="position: absolute">
          <button id='editGrid-{{ $a }}' class="fa fa-edit" style='float: right; padding-top: 5px;'></button>
          <button id='childGrid-{{ $a }}' class="fa fa-object-ungroup" style='float: right; padding-top: 5px; padding-right: 5px;'></button>
          <button id='delGrid-{{ $a }}' class="fa fa-trash  " style='float: right; padding-top: 5px;'></button>
        </div>
        <input type='hidden' id='idGambar{{$a}}' value='{{ $img[$a][4] }}' />
        <?php $a++ ?>
  @endfor
  </tr>
@endfor