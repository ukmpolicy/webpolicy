<div class="sidebar">

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            

            @foreach (getSidebarMenu() as $item)
                @if (count($item['dropmenu']) > 0)
                    @if (hasMenuPermission($item['name']))
                        
                        <li class="nav-item @if (containsInDropMenu($item['name'],Route::current()->getName())) menu-is-opening menu-open @endif">
                            <a href="{{ route($item['route']) }}" class="nav-link">
                                <i class="nav-icon fas fa-{{ $item['icon'] }}"></i>
                                <p>
                                    {{ $item['name'] }}
                                    @if (count($item['dropmenu']) > 0)
                                        <i class="right fas fa-angle-left"></i>
                                    @endif
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @foreach ($item['dropmenu'] as $dmenu)
                                    @if (hasPermissionByName($dmenu['permission']))
                                        <li class="nav-item">
                                            <a href="{{ route($dmenu['route']) }}" class="nav-link @if (Route::current()->getName() == $dmenu['route']) active @endif">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>{{ $dmenu['name'] }}</p>
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                    @endif
                @else
                    @if (hasPermissionByName($item['permission']))
                    <li class="nav-item @if (Route::current()->getName() == $item['route']) menu-is-opening menu-open @endif">
                        <a href="{{ route($item['route']) }}" class="nav-link @if (Route::current()->getName() == $item['route']) active @endif">
                            <i class="nav-icon fas fa-{{ $item['icon'] }}"></i>
                            <p>
                                {{ $item['name'] }}
                            </p>
                        </a>
                    </li>
                    @endif
                @endif
                
            @endforeach

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
