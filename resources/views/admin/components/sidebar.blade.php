@php
// Create Image Blob
@endphp

<div class="sidebar">

    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{ asset('dist/img/boxed-bg.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <div style="text-transform: capitalize" class="text-white">{{ auth()->user()->username }}</div>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link @if (Route::current()->getName() == 'dashboard') active @endif">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>

            @if (in_array(auth()->user()->level, [4]))
            <li class="nav-item">
                <a href="{{ route('user') }}" class="nav-link">
                    <i class="nav-icon fas fa-user-tie"></i>
                    <p>
                        User
                    </p>
                </a>
            </li>
            @endif
            @if (in_array(auth()->user()->level, [4, 2, 6]))
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-user-cog"></i>
                    <p>
                        Open Recruitment
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('member.or') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Peserta</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('member.or.settings') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Pengaturan</p>
                        </a>
                    </li>
                </ul>
            </li>
            @endif

            @if (in_array(auth()->user()->level, [4, 6]))
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        Kepengurusan
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('member') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Anggota</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('office') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Pengurus</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('division') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Bidang</p>
                        </a>
                    </li>
                </ul>
            </li>
            @endif

            @if (in_array(auth()->user()->level, [0,1,2,3,4,5]))
            <li class="nav-item">
                <a href="{{ route('article') }}" class="nav-link">
                    <i class="fa fa-file-alt nav-icon"></i>
                    <p>Artikel</p>
                </a>
            </li>
            @endif

            @if (in_array(auth()->user()->level, [4, 0]))
            <li class="nav-item">
                <a href="{{ route('documentation') }}" class="nav-link">
                    <i class="nav-icon fas fa-camera"></i>
                    <p>
                        Dokumentasi
                    </p>
                </a>
            </li>
            @endif

            @if (in_array(auth()->user()->level, [4, 0]))
            <li class="nav-item">
                <a href="{{ route('mail') }}" class="nav-link">
                    <i class="nav-icon fas fa-envelope"></i>
                    <p>Masukan</p>
                </a>
            </li>
            @endif

            <li class="nav-header">LAINNYA</li>

            <li class="nav-item">
                <a href="{{ route('main.home') }}" class="nav-link">
                    <i class="nav-icon fas fa-home"></i>
                    <p>
                        HOME
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button class="btn btn-link text-left text-warning nav-link btn-secondary">
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
