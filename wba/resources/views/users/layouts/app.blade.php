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
              <small>Selamat Datang</small>
              <h1 class="h4 text-uppercase">{{Auth::user()->name}}</h1>
              <p>Pelanggan</p>
            </div>
          </div>
          <!-- Sidebar Navidation Menus--><span class="heading">Menu</span>
          <ul class="list-unstyled">
            <li class="{{Request::path() == 'user/dashboard' ? 'active' : ''}}"><a href="{{route('user.dashboard')}}"><img src="{{url('icon/home.png')}}" width="30" alt=""><br>Home</a></li>
            <li class="{{Request::path() == 'user/borrow' ? 'active' : ''}}"><a href="{{route('user.borrow')}}"> <img src="{{url('icon/pinjam.png')}}" width="30" alt=""><br>Pinjaman</a></li>
            <li  class="{{Request::path() == 'user/saving' ? 'active' : ''}}"><a href="{{route('user.saving')}}"> <img src="{{url('icon/tabungan.png')}}" width="30" alt=""><br>Tabungan</a></li>

          <hr>
          <ul class="list-unstyled">
            <li class="{{Request::path() == 'user/setting' ? 'active' : ''}}"><a href="{{route('user.edit',Auth::user()->id)}}"><img src="{{url('icon/pengaturan.png')}}" width="30" alt=""><br>Pengaturan</a></li>
            <!-- <li> <a href="#"> <i class="icon-screen"></i>Demo </a></li>
            <li> <a href="#"> <i class="icon-mail"></i>Demo </a></li>
            <li> <a href="#"> <i class="icon-picture"></i>Demo </a></li> -->
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