<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
       <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">
         <i class="fas fa-user"></i>
          Xin chào, <b>{{ Auth::user()->fullname }}</b>
          <span class="badge badge-warning navbar-badge"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fa-solid fa-users"></i>  Quản lý nhân viên
          </a>
          <div class="dropdown-divider"></div>
          <a href="{{ url('admin/staff/profile') }}" class="dropdown-item">
            <i class="fa-solid fa-user-pen"></i> Thông tin tài khoản
            </a>
          <div class="dropdown-divider"></div>
          <a href="{{ url ('logout') }}" class="dropdown-item dropdown-footer">Thoát</a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->