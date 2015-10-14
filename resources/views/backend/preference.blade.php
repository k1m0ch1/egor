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
            <div class="row">
              <div class="col-xs-12">
                <div class="box">
                <div class="box-body">
                  <div class="nav-tabs-custom">
	                <!-- Tabs within a box -->
	                <ul class="nav nav-tabs pull-right">
	                  <li class="active">
	                  	<a href="#revenue-chart" data-toggle="tab">Website Image</a>
	                  </li>
	                  <li>
	                  	<a href="#sales-chart" data-toggle="tab">Website Title</a>
	                  </li>
	                  <li>
	                  	<a href="#background-site" data-toggle="tab">Website Background</a>
	                  </li>
	                  <li class="pull-left header"><i class="fa fa-inbox"></i> Sales</li>
	                </ul>
	                <div class="tab-content no-padding">
	                  <!-- Morris chart - Sales -->
	                  <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;">
	                  		<form action="{{route('image.preference.get')}}" method="POST" class="form-horizontal">
	                  			<div class="box-body">
								 {!! csrf_field() !!}
								  <div class="form-group" align='center'>
				                      	<img align="center" data-src='holder.js/200x200' />
				                        <input align='center' type="file" id="fileInput" class="form-control">
				                      <p class="help-block">Disarankan menggunakan File gambar .jpg atau .png dengan resolusi 100 x 100</p>
				                  </div>
								</div>
							</form>
	                  </div>
	                  <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
	                  		<form action="{{route('title.preference.get')}}" method="POST" class="form-horizontal">
	                  			<div class="box-body">
								 {!! csrf_field() !!}
								  <div class="form-group">
				                      <label for="inputTitle" class="col-sm-2 control-label">Title Website</label>
				                      <div class="col-sm-10">
				                        <input type="email" class="form-control" id="inputTitle" placeholder="Title Website">
				                      </div>
				                  </div>
				                  <div class="box-footer">
				                    <button type="submit" class="btn btn-info pull-right">Simpan</button>
				                  </div><!-- /.box-footer -->
								</div>
							</form>
	                  </div>
	                  <div class="chart tab-pane" id="background-site" style="position: relative; height: 300px;">
	                  </div>
	                </div>
	              </div><!-- /.nav-tabs-custom -->

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

    @include('_layout.footer-js-backend-user')
  </body>
</html>
