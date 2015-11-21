@include('_layout.header-backend')
<div class="wrapper">

      @include('_layout.sidebar-backend')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1 class="hidernyah">
            Dashboard
            <small class="hidernyah">Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li class="hidernyah"><a href="#" ><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active hidernyah">Dashboard</li>
          </ol>
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
                  <i class="fa fa-newspaper-o"></i>
                  <h3 class="box-title">News Control</h3>
                </div>
                <div class="box-body">
                <a href="{{route('admin.news.create')}}" class="btn btn-default"><i class="fa fa-plus"></i> Create News</a>
    						<div class="row">
    							<div class="col-lg-12 columns" >

                     <div class='box-body'>
                         <table id="results-table" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Category</th>
                        <th>Created at</th>
                        <th>Operation</th>
                      </tr>
                    </thead>
                    <tbody id="tbody-user">
                      @foreach($results as $result)
                        <tr><td><a href="{{route('admin.news.show', $result->id)}}">{{$result->title or "-"}}</a></a></td><td>{{$result->getAuthor()}}</td><td>{{$result->category or "-"}}</td><td>{{$result->created_at or "-"}}</td>
                        <td>

                          <form onsubmit="return confirm('Yakin Hapus Data?');" action="{{route('admin.news.destroy', $result->id)}}" method="POST">
                          <a href="{{route('admin.news.edit', $result->id)}}" class="btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
                          {!! method_field('DELETE') !!}
                          <button class="btn btn-danger"><i class="fa fa-times"></i> DELETE</button>
                          {!! csrf_field() !!}
                          </form>
                        </td></tr>
                      @endforeach
                    </tbody>
                  </table>
                    </div>
                    </div>
    							</div>
    						</div>
                </div>

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
