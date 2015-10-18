@include('_layout.header-backend')
<div class="wrapper">

      @include('_layout.sidebar-backend')
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Role
            <small>Control panel</small>
          </h1>
          @if(isset($breadcrumb))
            <ol class="breadcrumb">
              @foreach($breadcrumb as $key => $b)
                @if($key == 0)
                  <li><a href="#"><i class="fa fa-dashboard"></i> {{$b[0]}}</a></li>
                @else
                  @if($b[1] == 1)
                    <li class="active">{{$b[0]}}</li>
                  @else
                    <li>{{$b[0]}}</li>
                  @endif
                @endif
              @endforeach
            </ol>
          @endif
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <!-- Main row -->
            <div class="box-footer clearfix no-border">
                  <button class="btn btn-default pull-left" id='tambah'><i class="fa fa-plus"></i> Add item</button>
            </div>

            <div class="row">
              <div class="col-xs-12">
                <div class="box">
                  <div class="box-header">
                    <p>Roles Management Control Level</p>
                  </div>
                  <div class="box-body">
                  <table id="example1" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Display Name</th>
                        <th>Operation</th>
                      </tr>
                    </thead>
                    <tbody>
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
                    </tbody>
                  </table>
                </div>
              </div>
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.3.0
        </div>
        <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights reserved.
      </footer>

      <div id="dialog-form" title="Ubah User">     
        <form enctype="multipart/form-data" method='post' action='{{route("users[edit:save]")}}'>
        {!! csrf_field() !!}
          <fieldset id='formnyah'>

          </fieldset>
        </form>
      </div>
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    @include('_layout.footer-js-backend')
  </body>
</html>
