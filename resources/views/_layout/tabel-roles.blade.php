@foreach($result as $rS)
                        <tr>
                          <td>{{ $rS->name }}</td>
                          <td>{{$rS->display_name}}</td>
                          <td><div class="tools" align='center'>
                                <a class="fa fa-edit" id="editRule-{{ $rS->id }}"></a>&nbsp;
                                <a class="fa fa-trash-o"></a>
                              </div></td>
                        </tr>
@endforeach