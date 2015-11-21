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
            <div class="box box-info" style="border-top-color: #fffc08">
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

                      <th>Redirect to</th>
                      <th style="width: 40px">Operation</th>
                    </tr>
                    @foreach($result2 as $r2)
                      <tr>
                      <td>{{ $a++ }}</td>
                      <td><label id="lblName-{{ $r2->id }}">{{ $r2->name }}</label>
                          <input type='text' id='txtName-{{ $r2->id }}' value='{{ $r2->name }}' style="width: 150px; float: left;" size=1 class='form-control'/>
                          <button class="btn btn-primary" id="simpanName-{{ $r2->id }}" style="margin-left: 3px;"><i class="fa fa-save"></i></button>
                          <button class="btn btn-danger" id="cancelName-{{ $r2->id }}" style="margin-left: 1px;"><i class="fa fa-close"></i></button>
                      </td>

                      <td>
                          <label id="lblHref-{{ $r2->id }}">{{ $r2->redirect }}</label>
                          <input type='text' id='txtHref-{{ $r2->id }}' value='{{ $r2->redirect }}' style="width: 150px; float: left;" size=1 class='form-control'/>
                          <button class="btn btn-primary" id="simpanHref-{{ $r2->id }}" style="margin-left: 3px;"><i class="fa fa-save"></i></button>
                          <button class="btn btn-danger" id="cancelHref-{{ $r2->id }}" style="margin-left: 1px;"><i class="fa fa-close"></i></button>

                      </td>
                      <td><div class="tools" align='center'>
                      		  <!-- <a class="fa fa-object-ungroup" id='childMenu-{{$r2->id}}'>&nbsp;</a> -->
                              <a class="fa fa-edit" id='editMenu-{{$r2->id}}'></a>&nbsp;
                              <a class="fa fa-trash-o" id='delMenu-{{$r2->id}}'></a>
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

      <div id="child-form" title="Pengaturan Child Dialog">
      <form enctype="multipart/form-data" method='post' action='{{route("dashboard[edit:save]")}}'>
      {!! csrf_field() !!}
        <fieldset id='form-child'>

        </fieldset>
      </form>
    </div>

    <div id="add_child-form" title="Tambah Child">
      <form enctype="multipart/form-data" method='post' action='{{route("dashboard[edit:save]")}}'>
      {!! csrf_field() !!}
        <fieldset id='add_form-child'>

        </fieldset>
      </form>
    </div>
      @include('_layout.main-footer')
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    @include('_layout.footer-js-backend-user')
  </body>
</html>
