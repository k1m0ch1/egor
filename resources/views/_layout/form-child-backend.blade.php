<div class="box-body no-padding">
                  <table class="table" style="text-align: center;">
                    <tr style="text-align: center;">
                      <th colspan=2><center>#</center></th>
                      <th align='center'>Nama</th>
                      <th style="width: 40px">Operation</th>
                    </tr>
                    <?php $a=0; ?>
                    @foreach($datanya as $rS)
                    <tr style="text-align: center;">
                      <td>{{ ++$a }}.</td>
                      <td>
                        <img src="{{ asset('assets/img/uploaded') }}/{{ $rS->image}}" 
                             style="width:30px; height: 30px;"/>
                      </td>
                      <td>{{ $rS->nama }}</td>
                      <td>
                        <a id='editChild-{{$rS->id}}-{{$rS->parent_id}}' class="fa fa-edit" ></a>
                        <a id='delChild-{{$rS->id}}-{{$rS->parent_id}}' class="fa fa-trash" ></a>
                      </td>
                    </tr>
                    @endforeach
                  </table>
</div>