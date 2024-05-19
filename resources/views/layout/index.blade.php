<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Learning Management System</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="{{asset('assets/https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback')}}">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('assets/dist/css/adminlte.min.css')}}">
</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="{{asset('assets/dist/img/AdminLTELogo.png')}}" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-dark">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
          <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="fas fa-search"></i>
          </a>
          <div class="navbar-search-block">
            <form class="form-inline">
              <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                  <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
        <span class="brand-text font-weight-light">{{strtoupper("role" . ' '. Auth::user()->role)}}</span>
      </a>
      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">

          <div class="info">
            <a href="#" class="d-block">{{Auth::user()->firstName . ' ' . Auth::user()->lastName}}</a>
          </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>
        @switch(Auth::user()->role)
        @case('admin')
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item menu-open">
              <a href="{{url('/admin/dashboard')}}" class="nav-link {{Request::path() == 'admin/dashboard'?'active' :'' }} ">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>
            <li class="nav-header">Manage Data</li>
            <li class="nav-item">
              <a href="{{url('/admin/users')}}" class="nav-link {{Request::path() == 'admin/users'?'active' :'' }} ">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  Users
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('/admin/studies')}}" class="nav-link {{Request::path() == 'admin/studies'?'active' :'' }} ">
                <i class="nav-icon fas fa-book"></i>
                <p>
                  Studies
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('/admin/classes')}}" class="nav-link {{Request::path() == 'admin/classes'?'active' :'' }} ">
                <i class="nav-icon fas fa-door-open"></i>
                <p>
                  Classes
                </p>
              </a>
            </li>
            <form id="logout-form" action="{{ url('/auth/logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
            <li class="nav-item">
              <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>Logout</p>
              </a>
            </li>
          </ul>

        </nav>
        @break
        @case('teacher')
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item menu-open">
              <a href="{{url('/teacher/home')}}" class="nav-link {{Request::path() == 'teacher/home' ? 'active' : '' }} ">
                <i class="nav-icon fas fa-home"></i>
                <p>
                  Home
                </p>
              </a>
            </li>
            <li class="nav-header">Manage Class</li>
            <form id="logout-form" action="{{ url('/auth/logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
            <li class="nav-item">
              <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>Logout</p>
              </a>
            </li>
          </ul>
        </nav>
        @break
        @endswitch
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    @yield('content')
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <strong>Copyright &copy; 2024 <a href="#">Kritis</a>.</strong>
      All rights reserved.
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->
  <!-- jQuery -->
  <script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
  <!-- Bootstrap -->
  <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- overlayScrollbars -->
  <script src="{{asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('assets/dist/js/adminlte.js')}}"></script>

  <!-- jQuery Mapael -->
  <script src="{{asset('assets/plugins/jquery-mousewheel/jquery.mousewheel.js')}}"></script>
  <script src="{{asset('assets/plugins/raphael/raphael.min.js')}}"></script>
  <script src="{{asset('assets/plugins/jquery-mapael/jquery.mapael.min.js')}}"></script>
  <script src="{{asset('assets/plugins/jquery-mapael/maps/usa_states.min.js')}}"></script>
  <!-- ChartJS -->
  <script src="{{asset('assets/plugins/chart.js/Chart.min.js')}}"></script>


  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="{{asset('assets/dist/js/pages/dashboard2.js')}}"></script>
</body>

</html>