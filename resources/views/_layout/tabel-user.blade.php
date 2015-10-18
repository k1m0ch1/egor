@foreach($result as $rS)
                        <tr>
                          <td>{{$rS->name }}</td>
                          <td>{{$rS->roles}}</td>
                          <td>{{$rS->email}}</td>
                          <td><div class="tools" align='center'>
                                <a class="fa fa-edit" id="editUser-{{ $rS->id }}"></a>&nbsp;
                                <a class="fa fa-trash-o" id="delUser-{{ $rS->id }}"></a>
                              </div></td>
                        </tr>
                      @endforeach