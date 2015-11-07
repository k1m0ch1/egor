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
                <p>{{\Auth::user()->name}}</p>
                <a href="{{url('/logout')}}"> <i class="fa fa-circle text-sucess"></i> Online</a>
              @else
                <p>Name User</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
              @endif
            </div>
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
                @if(isset($sB->dashboard) && $sB->dashboard)
                  <li>
                    <a href='{{ asset("admin/dashboard") }}'>
                      <i class="fa fa-dashboard"></i> <span>Dashboard</span></i>
                    </a>
                  </li>
                @endif

                @if(isset($sB->menu_user) && $sB->menu_user)
                <li {{ $title=='Users'?'class="active treeview"':'' }} >
                    <a href='{{ asset("admin/user") }}'>
                    <i class="fa fa-users" href="user"></i> <span> Users</span>
                    </a>
                    <ul class="treeview-menu">
                      @if(isset($sB->user) && $sB->user)
                          <li>
                            <a href='{{ asset("admin/users") }}'>
                            <i class="fa fa-circle" href="user"></i> <span> User</span>
                            </a>
                          </li>
                      @endif
                      @if(isset($sB->role) && $sB->role)
                          <li>
                            <a href='{{ asset("admin/role") }}'>
                            <i class="fa fa-circle" href="user"></i> <span> Roles</span>
                            </a>
                          </li>
                      @endif
                      @if(isset($sB->permission) && $sB->permission)
                          <li>
                            <a href='{{ asset("admin/permission") }}'>
                            <i class="fa fa-circle" href="user"></i> <span> Permission</span>
                            </a>
                          </li>
                      @endif
                    </ul>
                </li>
                @endif

                @if(isset($sB->menu) && $sB->menu)
                  <li {{ $title=='Menu'?'class="active treeview"':'' }}>
                    <a href='{{ asset("admin/menu") }}'>
                      <i class="fa fa-th"></i> <span> Menu</span>
                    </a>
                  </li>
                @endif

                @if(isset($sB->module) && $sB->module)
                  <li {{ $title=='Module'?'class="active treeview"':'' }}>
                    <a href='{{ asset("admin/module") }}'>
                      <i class="fa fa-th"></i> <span> Module</span>
                    </a>
                  </li>
                @endif

                @if(isset($sB->gambar) && $sB->gambar)
                  <li {{ $title=='Image'?'class="active treeview"':'' }}>
                    <a href='{{ asset("admin/gambar") }}'>
                      <i class="fa fa-file-image-o"></i> <span> Images</span>
                    </a>
                  </li>
                @endif

                @if(isset($sB->preference) && $sB->preference)
                <li {{ $title=='Preference'?'class="active treeview"':'' }}>
                  <a href='{{ asset("admin/preference") }}'>
                    <i class="fa fa-gear"></i> <span> Preference</span>
                  </a>
                </li>
                @endif

                @if(isset($sB->news) && $sB->news)
                <li {{ $title=='News'?'class="active treeview"':'' }}>
                  <a href='{{ asset("admin/news") }}'>
                    <i class="fa fa-newspaper-o"></i> <span> News</span>
                  </a>
                </li>
                @endif

          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
