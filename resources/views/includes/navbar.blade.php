<!-- Navbar -->
<nav class="main-header d-flex justify-content-between custom-color navbar navbar-expand navbar-white">
    <!-- right navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="" class="nav-link">@lang('admin.home')</a>
        </li>
    </ul>
    <!-- left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item dropdown">
            <a class="nav-link pt-1" data-toggle="dropdown" href="#">
                <i class="fas fa-caret-down"></i>
                <div class="user-panel d-inline">
                    @lang('admin.language')
                </div>
            </a>

            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="min-width: 160px;">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <a hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" class="dropdown-item"> {{ $properties['native'] }} </a>
                @endforeach
            </div>
        </li>
    </ul>
</nav>
<!-- /.navbar -->


