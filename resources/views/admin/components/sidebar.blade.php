@php
    // Create Image Blob
@endphp

<div class="sidebar">

<!-- Sidebar user panel (optional) -->
<div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
        <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
    </div>
    <div class="info">
    <div style="text-transform: capitalize" class="text-white">{{ auth()->user()->username }}</div>
    </div>
</div>

<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
    <li class="nav-item">
        <a href="{{ route('dashboard') }}" class="nav-link @if (Route::current()->getName() == 'dashboard') active @endif">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
            Dashboard
        </p>
        </a>
    </li>
    @if (auth()->user()->level == 3)
    <li class="nav-item">
        <a href="{{ route('user') }}" class="nav-link">
        <i class="nav-icon fas fa-user"></i>
        <p>
            User
        </p>
        </a>
    </li>
    @endif
    @if (auth()->user()->level == 2 || auth()->user()->level == 3)
    <li class="nav-item">
        <a href="{{ route('member') }}" class="nav-link @if (Route::current()->getName() == 'members') active @endif">
        <i class="nav-icon fas fa-users"></i>
        <p>
            Anggota
        </p>
        </a>
    </li>
    
    <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-user-tie"></i>
          <p>
            Kepengurusan
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ route('office') }}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Pengurus</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('division') }}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Program Kerja</p>
            </a>
          </li>
        </ul>
    </li>
    @endif
    <li class="nav-item">
        <a href="{{ route('article') }}" class="nav-link">
        <i class="nav-icon fas fa-file-alt"></i>
        <p>
            Artikel
        </p>
        </a>
    </li>
    @if (auth()->user()->level == 1 || auth()->user()->level == 3)
    <li class="nav-item">
        <a href="{{ route('documentation') }}" class="nav-link">
        <i class="nav-icon fas fa-camera"></i>
        <p>
            Dokumentasi
        </p>
        </a>
    </li>
    @endif
    <li class="nav-item">
        <a href="{{ route('library') }}" class="nav-link">
        <i class="nav-icon fas fa-image"></i>
        <p>
            Pustaka
        </p>
        </a>
    </li>
    
    <li class="nav-header">LAINNYA</li>
    
    <li class="nav-item">
        <a href="" class="nav-link">
        <i class="nav-icon fas fa-home"></i>
        <p>
            HOME
        </p>
        </a>
    </li>
    <li class="nav-item">
        <form action="{{ route('logout') }}" method="post">
            @csrf
            <button class="btn btn-link text-left btn-light text-dark nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>
                    KELUAR
                </p>
            </button>
        </form>
    </li>
    </ul>
</nav>
<!-- /.sidebar-menu -->

</div>