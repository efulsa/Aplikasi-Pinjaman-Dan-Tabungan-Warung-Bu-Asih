<div class="navbar-holder d-flex align-items-center justify-content-between">
    <!-- Navbar Header-->
    <div class="navbar-header">
        <!-- Navbar Brand --><a href="index.html" class="navbar-brand d-none d-sm-inline-block">
            <div class="brand-text d-none d-lg-inline-block"><span>Warung </span> <strong>Bu Asih</strong></div>
            <div class="brand-text d-none d-sm-inline-block d-lg-none"><strong>WBA</strong></div>
        </a>
        <!-- Toggle Button--><a id="toggle-btn" href="#"><img src="{{url('icon/menu.png')}}" width="30" alt=""></a>
    </div>
    <!-- Navbar Menu -->
    <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">

        <!-- Logout    -->
        @guest
        <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
        </li>
        @if (Route::has('register'))
        <!-- <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li> -->
        @endif
        @else

        <li class="nav-item"><a href="{{ route('logout') }}" class="nav-link logout" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"> <span
                    class="d-none d-sm-inline">Logout
                </span><img src="{{url('icon/loguot.png')}}" width="28" alt=""></a></li>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

        @endguest
    </ul>
</div>