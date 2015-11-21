@include('_layout.header-backend')
<div class="wrapper">

      @include('_layout.sidebar-backend')
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper" style="background-color: #222d32;">
        <!-- Content Header (Page header) -->
        <section class="content-header" style="background-color: #222d32;">
          <h1 style="color: #ffffff;">
            Dashboard
            <small style="color: #ffffff;">Control panel</small>
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
            <div class="box box-info" style="border-top-color: #fffc08">
              <div class="box-header">
                <i class="fa fa-envelope"></i>
                <h3 class="box-title"></h3>
              </div>
                  <button class="btn btn-default pull-left" id='tambah'><i class="fa fa-plus"></i> Add item</button>
            </div>

            <div class="row">
              <div class="col-xs-12">
                <div class="box">
                  <div class="box-header">
                    <p>User Management Control Level</p>
                  </div>
                  <div class="box-body" style="min-height: 550px;">
                  <table id="example1" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Jabatan</th>
                        <th>Email</th>
                        <th>Operation</th>
                      </tr>
                    </thead>
                    <tbody id="tbody-user">

                    </tbody>
                  </table>
                </div>
              </div>
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
     @include('_layout.main-footer')
     <style>
     .dialogUser{
         margin-left: 500;
         left: 500 !important;
         right: 500 !important;
      }
     </style>
      <div id="dialog-form" title="Ubah User" >
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
