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
          <div class="row">

            <!-- Left col -->
              <!-- TO DO List -->
              <div class="box box-info" style="border-top-color: #fffc08">
              	<div class="box-header">
                  <i class="fa fa-dashboard"></i>
                  <h3 class="box-title">Dashboard Menu Management System</h3>
                </div>
                <div class="box-body">

                <div id="message-body">

                </div>
						<div class="row">
							<div class="col-lg-12 columns" >
                <div class='box-header'>
                  <div class='form-group'>
                    <h4>Ukuran Grid Menu</h4>

                    <select id='grid-dashboard'>
                      <option value='3x2' {{ $rS=='3x2'?'selected':'' }}>3x2</option>
                      <option value='3x3' {{ $rS=='3x3'?'selected':'' }}>3x3</option>
                      <option value='3x4' {{ $rS=='3x4'?'selected':'' }}>3x4</option>
                      <option value='4x2' {{ $rS=='4x2'?'selected':'' }}>4x2</option>
                      <option value='4x3' {{ $rS=='4x3'?'selected':'' }}>4x3</option>
                      <option value='4x4' {{ $rS=='4x4'?'selected':'' }}>4x4</option>
                    </select>
                  </div>
                </div>
                <hr/>
							</div>
            </div>
            <div class="row">
              <div class="col-lg-12 columns">
                <div class='box-body'>
                    <h4>Pengaturan Posisi Menu</h4>
                    <button type='submit' class="btn btn-success" id='simpan'><i class="fa fa-save"></i> Simpan Pengaturan</button>
                    <table border=0 id="menu-wrapper" align='center'>

                    </table>
                </div>
              </div>
						</div>
                </div>
                <div class="box box-info" style="border-top-color: #fffc08"></div>
              </div>
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
     @include('_layout.main-footer')

      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <div id="dialog-form" title="Ubah Menu">
      <form enctype="multipart/form-data" method='post' action='{{route("dashboard[edit:save]")}}'>
      {!! csrf_field() !!}
        <fieldset id='formnyah'>

        </fieldset>
      </form>
    </div>

    <div id="child-form" title="Pengaturan Child Dialog">
      <form enctype="multipart/form-data" method='post' action='{{route("dashboard[edit:save]")}}'>
      {!! csrf_field() !!}
        <fieldset id='form-child'>

        </fieldset>
      </form>
    </div>

    <div id="add-child-form" title="Ubah Menu Child">
      <form enctype="multipart/form-data" method='post' action='{{route("dashboard[edit:save]")}}'>
      {!! csrf_field() !!}
        <fieldset id='add-form_child'>

        </fieldset>
      </form>
    </div>

    @include('_layout.footer-js-backend');
  </body>
</html>
