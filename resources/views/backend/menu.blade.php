@include('_layout.header-backend')
<div class="wrapper">

      @include('_layout.sidebar-backend')

      <div class="content-wrapper">

        <section class="content-header">
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
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
                <div class="box-body">
                  <table class="table table-striped">
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Parent</th>
                      <th>Child</th>
                      <th>Redirect to</th>
                      <th style="width: 40px">Operation</th>
                    </tr>
                    @foreach($result2 as $r2)
                      <tr>
                      <td>{{ $a++ }}</td>
                      <td>{{ $r2->name }}</td>
                      <td>not yet</td>
                      <td>{{ $r2->redirect }}</td>
                      <td><div class="tools" align='center'>
                      		  <a class="fa fa-external-link">&nbsp;</a>
                              <a class="fa fa-edit"></a>&nbsp;
                              <a class="fa fa-trash-o"></a>
                            </div></td>
                      </tr>
                    @endforeach
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
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

      
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <div id="dialog-ajah" title="Create new user">
    BANGSAT
    </div>

    @include('_layout.footer-js-backend-user')
  </body>
</html>
