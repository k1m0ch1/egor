<div class="box-body no-padding">
<input type='hidden' id='parent_id' value="{{ $parent_id }}" />
                  <table class="table" style="text-align: center;" id="child-Form-table">
                    <tr style="text-align: center;">
                      <th ><center>#</center></th>
                      <th align='center'>Nama</th>
                      <th align='center'>Redirect</th>
                      <th style="width: 40px">Operation</th>
                    </tr>
                    <?php $a=0; ?>
                    @foreach($hasil as $rS)
                    <tr style="text-align: center;">
                      <td>{{ ++$a }}.</td>
                      <td>
                        <label id="lblName-{{ $rS->id }}">{{ $rS->name }}</label>
                        
                      </td>
                      <td>
                          <label id="lblHref-{{ $rS->id }}">{{ $rS->redirect }}</label>
                      </td>
                      <td>
                        <input type='hidden' id='current_parent_id' value="{{ $rS->parent_id }}" />
                        <input type='hidden' id='child_id' value="{{$rS->id}}" />
                        <a id='editChild-{{$rS->id}}-{{$rS->parent_id}}' class="fa fa-edit" ></a>
                        <a id='delChild-{{$rS->id}}-{{$rS->parent_id}}' class="fa fa-trash" ></a>
                      </td>
                    </tr>
                    @endforeach
                  </table>
</div>