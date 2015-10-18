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
                <div id="message-body">
						
					</div>
                  <div class="nav-tabs-custom">
	                <!-- Tabs within a box -->
	                <ul class="nav nav-tabs pull-right">
	                  <li class="active">
	                  	<a href="#logo-site" data-toggle="tab">Website Logo</a>
	                  </li>
	                  <li>
	                  	<a href="#sales-chart" data-toggle="tab">Website Title</a>
	                  </li>
	                  <li>
	                  	<a href="#background-site" data-toggle="tab">Website Background</a>
	                  </li>
	                  <li>
	                  	<a href="#footer-site" data-toggle="tab">Footer</a>
	                  </li>
	                  <li class="pull-left header"><i class="fa fa-inbox"></i> Setting Portal</li>
	                </ul>
	                <div class="tab-content no-padding">
	                  <!-- Morris chart - Sales -->
	                  <div class="chart tab-pane active" id="logo-site" style="position: relative; height: 1000px;">
	                  		<div class="box-body">
	                  		<form id="uploadLogo" method="post" action="gambar[Logo:upload]" enctype="multipart/form-data">
								      {!! csrf_field() !!}
		            			<div id="drop-Logo">
									Drop Here or
									<a>Browse</a>
									<input type="file" name="upl-Logo" multiple />
								</div>
								<ul id='ulLogo'>
									<!-- The file uploads will be shown here -->
								</ul>
							</form>
	                  		<form method="POST" class="form-horizontal" id="FormLogo">
								 {!! csrf_field() !!}
								  <div class="form-group" align='center' id="FileLogo">
				                      	
				                  </div>
				                  <div class="box-footer">
				                    <button type="submit" class="btn btn-info pull-right" id="simpan">Simpan</button>
				                  </div>								
							</form>
							</div>
	                  </div>
	                  <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
	                  		<form method="POST" class="form-horizontal" id="FormTitle">
	                  			<div class="box-body">
								 {!! csrf_field() !!}
								  <div class="form-group">
				                      <label for="inputTitle" class="col-sm-2 control-label">Title Website</label>
				                      <div class="col-sm-10">
				                        <input type="text" value="{{ $result2 }}" class="form-control" id="inputTitle" placeholder="Title Website">
				                      </div>
				                  </div>
				                  <div class="box-footer">
				                    <button type="submit" class="btn btn-info pull-right" id="simpanTitle">Simpan</button>
				                  </div><!-- /.box-footer -->
								</div>
							</form>
	                  </div>
	                  <div class="chart tab-pane" id="background-site" style="position: relative; height: 1000px;">
	                  		<div class="box-body">
	                  			<form id="uploadBg" method="post" action="gambar[BG:upload]" enctype="multipart/form-data">
								      {!! csrf_field() !!}
			            			<div id="drop-Bg">
										Drop Here or
										<a>Browse</a>
										<input type="file" name="upl-Bg" multiple />
									</div>
									<ul id='ulBg'>
										<!-- The file uploads will be shown here -->
									</ul>
								</form>
								<form method="POST" class="form-horizontal" id="FormBackground">
										{!! csrf_field() !!}
									  <div class="form-group" align='center' id='FileBG'>
					                      	
					                  </div>
					                  <div class="box-footer">
					                    <button type="submit" class="btn btn-info pull-right" id="simpanBackground">Simpan</button>
					                  </div>								
								</form>
							</div>
	                  </div>
	                  <div class="chart tab-pane" id="footer-site" style="position: relative; height: 1000px;">
	                  		<div class="box-body">								
								<form method="POST" class="form-horizontal" id="FormFooter">
										{!! csrf_field() !!}
									  <div class="form-group" align='center'>
					                      	<div class="form-group">
							                      <label for="inputFooter" class="col-sm-2 control-label">Footer Website</label>
							                      <div class="col-sm-10">
							                        <input type="text" value="{{ $result3 }}" class="form-control" id="inputFooter" placeholder="Footer Website">
							                      </div>
							                  </div>
					                  </div>
					                  <div class="box-footer">
					                    <button type="submit" class="btn btn-info pull-right" id="simpanBackground">Simpan</button>
					                  </div>								
								</form>
							</div>
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

    @include('_layout.footer-js-backend');
  </body>
</html>
