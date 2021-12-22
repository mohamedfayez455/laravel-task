<!-- Navbar -->
<nav class="main-header d-flex justify-content-between custom-color navbar navbar-expand navbar-white">
    <!-- right navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" id="page-down"><i class=" fas fa-chevron-circle-down"></i></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>

        @yield('title')

    </ul>
    <!-- left navbar links -->
    <ul class="navbar-nav" style="margin-left: -25px">
        <li class="nav-item dropdown">
            <a class="nav-link pt-1" data-toggle="dropdown" href="#">
                <i class="fas fa-caret-down"></i>
                <div class="user-panel d-inline">
                    <div class="image">
                        <img src="{{asset('admin/assets/dist/img/avatar04.png')}}" class="img-circle elevation-2" alt="User Image">
                    </div>
                </div>
            </a>

            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="" class="dropdown-item"><i class="fas fa-user-cog"></i> {{auth()->user()->name}}</a>

                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{route('logout')}}">
                    <i class="fas fa-door-open"></i> تسجيل خروج
                </a>
            </div>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
