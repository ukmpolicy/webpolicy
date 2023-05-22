<!DOCTYPE html>
<html lang="en">
<head>
  @include('guest.includes.main_header')
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  @include('guest.includes.style')
  <link rel="canonical" href="{{ route('main.home') }}">
  <link rel="shortcut icon" href="{{ asset('images/policy.png') }}" type="image/x-icon">
</head>
<body id="user">
  @include('guest.includes.navbar')
  <div class="user-container">
    
    <ul class="nav nav-pills nav-fill">
      <li class="nav-item">
        <a class="nav-link {{ 
          request()->is(getURLPath(route('user.profile', ['username' => Auth::user()->username]) )) ? 'active' : '' 
          }}" href="{{ route('user.profile', ['username' => Auth::user()->username]) }}">
          <i class="fa fa-fw fa-user"></i>
          <span class="nav-text">Profile</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ 
          request()->is(getURLPath(route('user.notifications') )) ? 'active' : '' 
          }}" href="{{ route('user.notifications') }}">
          <i class="fa fa-fw fa-bell"></i>
          <span class="nav-text">Notifications</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ 
          request()->is(getURLPath(route('user.open-recruitment') )) ? 'active' : '' 
          }}" href="{{ route('user.open-recruitment') }}">
          <i class="fa fa-fw fa-user-plus"></i>
          <span class="nav-text">Open Recruitment</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ 
          request()->is(getURLPath(route('user.settings') )) ? 'active' : '' 
          }}" href="{{ route('user.settings') }}">
          <i class="fa fa-fw fa-cog"></i>
          <span class="nav-text">Settings</span>
        </a>
      </li>
    </ul>
    <div class="user-content">
      @yield('content')
    </div>
  </div>
  @include('guest.includes.footer')
  <script src="{{ asset('plugins/jquery/jquery.js') }}"></script>
  <script src="{{ asset('plugins/popper/esm/popper.min.js') }}"></script>
  <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/page.js') }}"></script>
  <script>
      document.querySelector('#navbar').classList.add('scroll')
  </script>
</body>
</html>