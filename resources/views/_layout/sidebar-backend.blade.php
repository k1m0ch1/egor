<!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img data-src="holder.js/90x60" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p>Name User</p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
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
            <li>
              <a href='{{ asset("index.php/admin/dashboard") }}'>
                <i class="fa fa-dashboard"></i> <span>Dashboard</span></i>
              </a>
            </li>

            <li {{ $title=='Users'?'class="active treeview"':'' }} >
                <a href='{{ asset("index.php/admin/user") }}'>
                <i class="fa fa-users" href="user"></i> <span> Users</span>
                </a>
            </li>
              
            <li {{ $title=='Menu'?'class="active treeview"':'' }}>
              <a href='{{ asset("index.php/admin/menu") }}'>
                <i class="fa fa-th"></i> <span> Menu</span>
              </a>
            </li>

            <li {{ $title=='Image'?'class="active treeview"':'' }}>
              <a href='{{ asset("index.php/admin/gambar") }}'>
                <i class="fa fa-file-image-o"></i> <span> Images</span>
              </a>
            </li>

            <li {{ $title=='Preference'?'class="active treeview"':'' }}>
              <a href='{{ asset("index.php/admin/preference") }}'>
                <i class="fa fa-gear"></i> <span> Preference</span>
              </a>
            </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>