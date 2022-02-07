<nav class="navbar navbar-expand-lg main-navbar">
    <a href="{{ route('dashboard') }}" class="navbar-brand sidebar-gone-hide">{{ config('app.name') }}</a>

    <div class="navbar-nav">
        <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar">
            <i class="fas fa-bars"></i>
        </a>
    </div>

    <div class="nav-collapse">
        <a class="sidebar-gone-show nav-collapse-toggle nav-link" href="#">
            <i class="fas fa-ellipsis-v"></i>
        </a>

        <ul class="navbar-nav">
            @can('view-dashboard')
                <li class="nav-item @if (Route::is('dashboard')) active @endif">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <span>@lang('menu.dashboard')</span>
                    </a>
                </li>
            @endcan

            @can('view-master')
                <li class="nav-item @if (Route::is('master.*')) active @endif">
                    <a href="{{ route('master.index') }}" class="nav-link">
                        <span>@lang('menu.master')</span>
                    </a>
                </li>
            @endcan

            <li class="nav-item @if (Route::is('education.*')) active @endif">
                <a href="{{ route('education.index') }}" class="nav-link">
                    <span>@lang('menu.education')</span>
                </a>
            </li>

            <li class="nav-item @if (Route::is('monitoring.*')) active @endif">
                <a href="{{ route('monitoring.index') }}" class="nav-link">
                    <span>@lang('menu.monitoring')</span>
                </a>
            </li>

            <li class="nav-item @if (Route::is('report.*')) active @endif">
                <a href="{{ route('report.index') }}" class="nav-link">
                    <span>@lang('menu.report')</span>
                </a>
            </li>
        </ul>
    </div>

    <ul class="navbar-nav navbar-right ml-auto">
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="{{ Auth::user()->profile_image }}" class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block">{{ Auth::user()->name }}</div>
            </a>

            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title">
                    <span>🇮🇩 {{ Auth::user()->username }}</span>
                </div>

                <a href="{{ route('profile.edit') }}" class="dropdown-item has-icon @if (Route::is('profile.*')) active @endif">
                    <i class="fas fa-user"></i> @lang('Profile')
                </a>

                <div class="dropdown-divider"></div>

                @if (Auth::check() && Route::has('logout'))
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger" onclick="event.preventDefault(); this.closest('form').submit();">
                            <i class="fas fa-sign-out-alt"></i> @lang('Log Out')
                        </a>
                    </form>
                @endif
            </div>
        </li>
    </ul>
</nav>
