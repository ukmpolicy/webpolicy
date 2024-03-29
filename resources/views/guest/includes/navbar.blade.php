<nav id="navbar" class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <div class="d-flex" id="logo">
            <button class="navbar-toggler" style="margin-right: 1rem" type="button" data-toggle="collapse" data-target="#topbar" aria-controls="topbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a href="{{ route('main.home') }}" class="navbar-brand">
                <img src="{{ asset('images/policy2.png') }}" alt="">
                <span class="marktext">UKM POLICY</span>
            </a>
        </div>

        <div class="navbar-collapse collapse" id="topbar">
            <ul class="navbar-nav nav">
                <li class="nav-item">
                    <a class="nav-link{{ request()->is([getURLPath(route('home')), '/']) ? ' active' : '' }}" href="{{ route('main.home') }}">Home</i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link{{ request()->is(getURLPath(route('main.articles'))) ? ' active' : '' }}" href="{{ route('main.articles') }}">Blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link{{ request()->is(getURLPath(route('main.documentations'))) ? ' active' : '' }}" href="{{ route('main.documentations') }}">Documentation</a>
                </li>
            </ul>
        </div>
        @if (Auth::check())
        <div class="dropdown show" id="navbar-picture">
            <a href="" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span>{{ explode(" ", Auth::user()->name)[0] }}</span>
                <img class="d-block rounded-circle overflow-hidden" src="{{ Auth::user()->getPicture() }}" class="w-100 h-100" alt="">
            </a>
            
            <div class="dropdown-menu" style="right: 0 !important;left:auto;top:120%" aria-labelledby="navbar-picture">
                <a class="dropdown-item" href="{{ route('user.profile', ['username' => Auth::user()->username]) }}">
                    <i class="fa fa-user fa-fw"></i> Profile
                </a>
                <a class="dropdown-item" href="{{ route('user.notifications') }}">
                    <i class="fa fa-bell fa-fw"></i> Notifications
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fa fa-user-plus fa-fw"></i> Open Recruitmen
                </a>
                <a class="dropdown-item" href="{{ route('user.settings') }}">
                    <i class="fa fa-cog fa-fw"></i> Settings
                </a>
                <div class="dropdown-divider"></div>
                @if (hasPermissionByName('admin'))
                    <a class="dropdown-item" href="{{ route('dashboard') }}">
                        <i class="fa fa-user-tie fa-fw"></i> Manager
                    </a>
                @endif
                <a class="dropdown-item" href="#" onclick="event.preventDefault();document.querySelector('#logout').submit()">
                    <i class="fa fa-sign-out-alt fa-fw"></i> Logout
                </a>
                <form action="{{ route('logout') }}" method="post" id="logout">@csrf</form>
            </div>
        </div>
        @else
            <a href="{{ route('login') }}" class="btn btn-danger" href="{{ route('main.documentations') }}">SIGN IN</a>
        @endif
    </div>
</nav>
