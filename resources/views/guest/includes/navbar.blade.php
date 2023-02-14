<nav id="navbar" class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a href="{{ route('main.home') }}" class="navbar-brand">
            <img src="{{ asset('images/policy2.png') }}" alt="">
            UKM POLICY
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#topbar" aria-controls="topbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
        <div class="navbar-collapse collapse" id="topbar">
            <ul class="navbar-nav nav">
                <li class="nav-item">
                    <a class="nav-link{{ request()->is('/') ? ' active' : '' }}" href="{{ route('main.home') }}">Beranda</i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link{{ request()->is('blog') ? ' active' : '' }}" href="{{ route('main.articles') }}">Blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link{{ request()->is('documentation') ? ' active' : '' }}" href="{{ route('main.documentations') }}">Dokumentasi</a>
                </li>
                @auth
                    @if (hasPermissionByName('admin'))
                        <li class="nav-item">
                            <div class="nav-btn">
                                <a href="{{ route('dashboard') }}" class="btn btn-outline-danger">MANAGER</a>
                            </div>
                        </li>
                    @endif
                @endauth
                <li class="nav-item">
                    @if (Auth::check())
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button class="btn btn-danger">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-danger" href="{{ route('main.documentations') }}">SIGN IN</a>
                    @endif
                </li>
            </ul>
        </div>
    </div>
</nav>
