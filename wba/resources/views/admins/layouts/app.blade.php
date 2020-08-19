<!DOCTYPE html>
<html>
  <head>
@include('admins.layouts.head')
  </head>
  <body>
    <div class="page">
      <!-- Main Navbar-->
      <header class="header">
        <nav class="navbar">
          <div class="container-fluid">
            @include('admins.layouts.navbar')
          </div>
        </nav>
      </header>
      <div class="page-content d-flex align-items-stretch"> 
        <!-- Side Navbar -->
        <nav class="side-navbar text-nowrap">
          <!-- Sidebar Header-->
          <div class="sidebar-header d-flex align-items-center">
            <div class="avatar"><img src="{{url('icon/warung.png')}}" alt="..." class="img" width="60"></div>
            <div class="title">
              <h1 class="h4">{{Auth::user()->name}}</h1>
              <p>Administrator</p>
            </div>
          </div>
          <!-- Sidebar Navidation Menus--><span class="heading">Menu</span>
          <ul class="list-unstyled">
            <li class="{{Request::path() == 'admin/dashboard' ? 'active' : ''}}"><a href="{{route('admin.dashboard')}}"><img src="{{url('icon/home.png')}}" width="30" alt=""><br>Home</a></li>
            <li class="{{Request::path() == 'admin/customer' ? 'active' : ''}}"><a href="{{route('admin.customer.index')}}"> <img src="{{url('icon/user.png')}}" width="30" alt=""><br>Pelanggan</a></li>
            <li class="{{Request::path() == 'admin/borrow' ? 'active' : ''}}"><a href="{{route('admin.borrow.index')}}"> <img src="{{url('icon/pinjam.png')}}" width="30" alt=""><br>Pinjaman</a></li>
            <li  class="{{Request::path() == 'admin/saving' ? 'active' : ''}}"><a href="{{route('admin.saving.index')}}"> <img src="{{url('icon/tabungan.png')}}" width="30" alt=""><br>Tabungan </a></li>
          </ul><hr>
          <ul class="list-unstyled">
            <li> <a href="#"> <img src="{{url('icon/pengaturan.png')}}" width="30" alt=""><br>Pengaturan </a></li>
          </ul>
        </nav>
        <div class="content-inner">
        @yield('content')
        </div>
      </div>
    </div>
  
    <!-- JavaScript files-->
    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"> </script>
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/jquery.cookie.js')}}"> </script>
    <script src="{{asset('js/Chart.min.js')}}"></script>
    <script src="{{asset('js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('js/charts-home.js')}}"></script>
    <!-- Main File-->
    <script src="{{asset('js/front.js')}}"></script>
  </body>
</html>