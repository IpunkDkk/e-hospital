<nav class="main-sidebar ps-menu">
    <div class="sidebar-toggle action-toggle">
        <a href="#">
            <i class="fas fa-bars"></i>
        </a>
    </div>
    <div class="sidebar-opener action-toggle">
        <a href="#">
            <i class="ti-angle-right"></i>
        </a>
    </div>
    <div class="sidebar-header">
        <div class="text">E-Sakit</div>
        <div class="close-sidebar action-toggle">
            <i class="ti-close"></i>
        </div>
    </div>
    <div class="sidebar-content">
        <ul>
            <li class="{{request()->segment(1) == 'dashboard' ? 'active' : ''}}">
                <a href="#" class="link">
                    <i class="ti-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            @foreach(getMainMenu() as $menu)
                @can('read '. $menu->url)
                <li class="{{request()->segment(1) == $menu->url ? 'active' : ''}}">
                    <a href="#" class="main-menu has-dropdown">
                        <i class="{{$menu->icon}}"></i>
                        <span>{{$menu->name}}</span>
                    </a>
                    <ul class="sub-menu {{request()->segment(1) == $menu->url ? 'expands' : ''}}">
                        @foreach($menu->subMenus as $submenu)
                            @can('read '. $submenu->url)
                                <li class="{{request()->segment(1) == explode('/', $submenu->url)[0] && request()->segment(2) == explode('/',$submenu->url)[1] ? 'active' : ''}}">
                                    <a href="{{url($submenu->url)}}" class="link"><span>{{$submenu->name}}</span></a>
                                </li>
                            @endcan
                        @endforeach
                    </ul>
                </li>
                @endcan
            @endforeach
        </ul>
    </div>
</nav>
