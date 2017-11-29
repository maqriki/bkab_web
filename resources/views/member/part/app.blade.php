<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('/min/dist/css/helper.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('/min/bower_components/font-awesome/css/font-awesome.min.css')}}">

    @yield('custom-style')
</head>
<body>
  <div id="app">
    <nav class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">

          <!-- Collapsed Hamburger -->
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
              <span class="sr-only">Toggle Navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
          </button>

          <!-- Branding Image -->
          <a class="navbar-brand" href="{{ url('/') }}">
              Pariwisata Batang
          </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
          <!-- Left Side Of Navbar -->
          <ul class="nav navbar-nav">
            <li><a href="{{ url('/wisata') }}">Wisata</a></li>
            <li><a href="{{ url('/event') }}">Event</a></li>
            <li><a href="{{ url('/paket-wisata') }}">Paket Wisata</a></li>
          </ul>

          <!-- Right Side Of Navbar -->
          <ul class="nav navbar-nav navbar-right">
            <li><a href="{{ url('/shopping-cart') }}">Cart 
            <span class="badge">{{ Session::has('cart') ? Session::get('cart')->totalQty : '' }}</span></a></li>
            <!-- Authentication Links -->
            @guest
              <li><a href="{{ route('login') }}">Login</a></li>
              <li><a href="{{ route('register') }}">Register</a></li>
            @else
              @if(Auth::user()->user_role==9)
                <li class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#">User
                  <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="{{url('/member/profile')}}">Profile</a></li>
                    <li><a href="{{url('/member/account')}}">Account</a></li>
                    <li><a href="{{url('/member/order')}}">Order History</a></li>
                    <li>
                      <a href="{{ route('logout') }}"
                          onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                          Logout
                      </a>

                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          {{ csrf_field() }}
                      </form>
                    </li>
                  </ul>
                </li>                
              @endif
              <!-- <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                  {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <ul class="dropdown-menu" role="menu">
                  <li>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                        Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                  </li>
                </ul>
              </li> -->
            @endguest
          </ul>
        </div>
      </div>
    </nav>

    @yield('content')
  </div>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}"></script>

    @yield('custom-script')
</body>
</html>
