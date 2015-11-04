<!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel" style="min-height: 75px;">
            <div class="pull-left image">
              @if(\Auth::check())
              <img data-src="holder.js/90x60" class="img-circle" src="{{asset(\App\Models\User::UPLOAD_PATH)}}/{{\Auth::user()->avatar}}" alt="">
              @else
              <img data-src="holder.js/90x60" class="img-circle" alt="User Image">
              @endif
            </div>
            <div class="pull-left info">
              @if(\Auth::check())
                <p><a id='userProfile'>{{\Auth::user()->name}}</a></p>
                <a href="{{url('/logout')}}"> <i class="fa fa-circle text-sucess"></i> Logout</a>
              @else
                <p>Name User</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Logout</a>
              @endif
            </div>
            <script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js') }}"></script>
            <script>
            $(document).ready(function(){

              var dialog;
              dialog = $( "#dialog-form-profile" ).dialog({
                autoOpen: false,
                height: 420,
                width: 700,
                modal: true,
                draggable: false,
                resizable: false,
                buttons: {
                  "Simpan": simpan,
                  Cancel: function() {
                    dialog.dialog( "close" );
                  }
                },
                close: function() {
                  form[0].reset();
                }
              });

              form = dialog.find( "form-profile" ).on( "submit", function( event ) {
                 event.preventDefault();
                 simpan();
               });

              $('#userProfile').on('click', function(){
                  var idnyah = {{\Auth::user()->id}};
                      dialog.dialog( "open" );
                      $.ajax({
                        url:  host + 'admin/users[edit:show]',
                        type: 'GET',
                        data: { id: idnyah },
                        dataType: 'html',
                        success: function(data) {
                          $('#formnyah-profile').html(data);
                        }
                     });
              });

              function simpan(){
              	var a = $('#dialog-form form input#name').val();
          	    var b = $('#dialog-form form input#email').val();
          	    var d = $('#dialog-form form input#idnyah').val();
                var e = $("#dialog-form form input[type=radio][name=roles]:checked").val();
                var f = d=="xxx"?$('#dialog-form form input#password').val():"";
                var g = $('#dialog-form form input#phone').val();
                var h = $('#dialog-form form input#jabatan').val();
                var i = $('#dialog-form form input#Upassword').val();
                var j = $('#dialog-form form input#nip').val();

                var fd = new FormData();
                fd.append("name", a);
                fd.append("email", b);
                fd.append("avatar", $('#fileUpload').prop('files')[0]);
                if(d != 'xxx'){
                  fd.append("id", d);
                }
                fd.append("roles", e);
                fd.append("password", f);
                fd.append("password_confirmation", i);
                fd.append("as", "add");
                fd.append("phone", g);
                fd.append("department", h);
                fd.append("nip", j);
              	$.ajax({
          	            url: host+ 'admin/users[edit:save]',
          	            type: 'POST',
                        processData: false,
                        contentType: false,
          	            data: fd,
          	            dataType: 'html',
          	            success: function(data) {
          	            	$.ajax({
                          });
          	            }
          	         });
              	dialog.dialog("close");
              }
            });
            </script>
          </div>
          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header" {{ $title=='Dashboard'?'class="active treeview"':'' }}>MAIN NAVIGATION</li>
              <li>
                <a href='{{ asset("/") }}'>
                  <i class="fa fa-home"></i> <span>Homepage</span></i>
                </a>
              </li>
                @if($sB->dashboard)
                  <li>
                    <a href='{{ asset("admin/dashboard") }}'>
                      <i class="fa fa-dashboard"></i> <span>Dashboard</span></i>
                    </a>
                  </li>
                @endif

                @if($sB->menu_user)
                <li {{ $title=='Users'?'class="active treeview"':'' }} >
                    <a href='{{ asset("admin/user") }}'>
                    <i class="fa fa-users" href="user"></i> <span> Users</span>
                    </a>
                    <ul class="treeview-menu">
                      @if($sB->user)
                          <li>
                            <a href='{{ asset("admin/users") }}'>
                            <i class="fa fa-circle" href="user"></i> <span> User</span>
                            </a>
                          </li>
                      @endif
                      @if($sB->role)
                          <li>
                            <a href='{{ asset("admin/role") }}'>
                            <i class="fa fa-circle" href="user"></i> <span> Roles</span>
                            </a>
                          </li>
                      @endif
                      @if($sB->permission)
                          <li>
                            <a href='{{ asset("admin/permission") }}'>
                            <i class="fa fa-circle" href="user"></i> <span> Permission</span>
                            </a>
                          </li>
                      @endif
                    </ul>
                </li>
                @endif

                @if($sB->menu)
                  <li {{ $title=='Menu'?'class="active treeview"':'' }}>
                    <a href='{{ asset("admin/menu") }}'>
                      <i class="fa fa-th"></i> <span> Menu</span>
                    </a>
                  </li>
                @endif

                @if($sB->module)
                  <li {{ $title=='Module'?'class="active treeview"':'' }}>
                    <a href='{{ asset("admin/module") }}'>
                      <i class="fa fa-th"></i> <span> Module</span>
                    </a>
                  </li>
                @endif

                @if($sB->gambar)
                  <li {{ $title=='Image'?'class="active treeview"':'' }}>
                    <a href='{{ asset("admin/gambar") }}'>
                      <i class="fa fa-file-image-o"></i> <span> Images</span>
                    </a>
                  </li>
                @endif

                @if($sB->preference)
                <li {{ $title=='Preference'?'class="active treeview"':'' }}>
                  <a href='{{ asset("admin/preference") }}'>
                    <i class="fa fa-gear"></i> <span> Preference</span>
                  </a>
                </li>
                @endif

          </ul>
        </section>
        <!-- /.sidebar -->
        <div id="dialog-form-profile" title="Ubah User">
          <form enctype="multipart/form-data" method='post' action='{{route("users[edit:save]")}}'>
          {!! csrf_field() !!}
            <fieldset id='formnyah-profile'>

            </fieldset>
          </form>
        </div>
      </aside>
