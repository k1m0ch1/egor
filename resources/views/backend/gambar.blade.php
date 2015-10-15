@include('_layout.header-backend')
<div class="wrapper">

      @include('_layout.sidebar-backend')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
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
          <div class="row">

            <!-- Left col -->
              <!-- TO DO List -->
              <div class="box box-info">
              	<div class="box-header">
                  <i class="fa fa-envelope"></i>
                  <h3 class="box-title">Image Control</h3>
                </div>
                <div class="box-body">
						<div class="row">
							<div class="large-12 columns" >
                <div class='box-header'>
                  <div class='form-group'>
                    <form id="upload" method="post" action="gambar[upload]" enctype="multipart/form-data">
						      {!! csrf_field() !!}
            <div id="drop">
							Drop Here or
							<a>Browse</a>
							<input type="file" name="upl" multiple />
						</div>
						<ul>
							<!-- The file uploads will be shown here -->
						</ul>
					</form>
                  </div>
                </div>
                 <div class='box-body'>
                    @if($files!=null)
                    <select class="image-picker show-html">
                      @for($a=0;$a<sizeOf($files);$a++)
                        <?php $filename = explode( '/', $files[$a]); ?>
                        <option data-img-src="{{ asset('assets/img/uploaded') }}/{{ $filename[10] }}" value="{{ $filename[10] }}">  {{ $filename[10] }}  </option>
                      @endfor
                    </select>
                    @endif
                </div>
							</div>
						</div>
                </div>
                <div class="box-footer clearfix no-border"></div>
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

      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <div id="dialog-form" title="Ubah Gambar">     
      <form enctype="multipart/form-data" method='post' action='{{route("dashboard[edit:save]")}}'>
      {!! csrf_field() !!}
        <fieldset id='formnyah'>
          
        </fieldset>
      </form>
    </div>

    @include('_layout.footer-js-backend');
  </body>
</html>
