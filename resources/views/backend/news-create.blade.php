@include('_layout.header-backend')
<script type="text/javascript" src="{{asset('assets/vendor/tinymce/tinymce.min.js')}}"></script>
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
              <div class="box box-info" style="border-top-color: #fffc08">
              	<div class="box-header">
                  <i class="fa fa-newspaper-o"></i>
                  <h3 class="box-title">News Control</h3>
                </div>
                <div class="box-body" style="min-height: 550px;">
                  <div class="container">
                    <div class="row">
                      <div class="col-lg-8 col-lg-offset-2">
                        @if(isset($result))
                        <form action="{{route('admin.news.update', $result->id)}}" method="POST" enctype="multipart/form-data">
                        {!! method_field('PUT') !!}
                        @else
                        <form action="{{route('admin.news.store')}}" method="POST" enctype="multipart/form-data">
                        @endif
                          <div class="form-group">
                            <label for="title">Judul Berita</label>
                            <input type="text" name="title" class="form-control" id="title" value="{{$result->title or ""}}">
                          </div>
                          <div class="form-group">
                            <label for="content">Isi Berita</label>
                            <textarea name="content" id="" cols="30" rows="10" class="form-control tinymce" id="content">{{$result->content or ""}}</textarea>
                          </div>
                          <div class="form-group">
                            <label for="category">Kategori Berita</label>
                            <input type="text" name="category" class="form-control" id="category" value="{{$result->category or ""}}">
                          </div>
                          <div class="form-group">
                            <label for="image">Gambar Utama Berita</label>
                            <input type="file" name="image" id="image">
                          </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-12 text-center">
                          @if(isset($result->image))
                          <img id="preview" src="{{asset(\App\Models\News::UPLOAD_PATH)}}/{{$result->image}}" data-src="holder.js/960x480" alt="">
                          @else
                          <img id="preview" src="" data-src="holder.js/960x480" alt="">
                          @endif
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-8 col-lg-offset-2 text-center">
                         <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          <input type="submit" class="btn btn-success btn-lg" value="Submit" style="margin-top: 40px;">
                        </form>
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
    @include('_layout.footer-js-backend');
    <script type="text/javascript">
      tinymce.init({
        selector : ".tinymce",
        plugins : "link image hr textcolor table",
        toolbar1 : "core",
        toolbar2: "alignleft aligncenter alignright | undo redo  | bold italic | hr | link image | forecolor backcolor | table",
      });

      $("#image").on("change", handleImage);

      function handleImage(){
        console.log(this.files[0]);

        var reader = new FileReader();
        reader.onload = function(e){
          $("#preview").attr("src", e.target.result);
        }

        reader.readAsDataURL(this.files[0]);
      }
    </script>
  </body>
</html>
