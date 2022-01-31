<nav class="navbar navbar-expand-lg main-navbar">
    <a href="{{ route('dashboard') }}" class="navbar-brand sidebar-gone-hide">{{ config('app.name') }}</a>

    <div class="navbar-nav">
        <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"></i></a>
    </div>

    <div class="nav-collapse">
        <a class="sidebar-gone-show nav-collapse-toggle nav-link" href="#">
            <i class="fas fa-ellipsis-v"></i>
        </a>
        <ul class="navbar-nav">
            <li class="nav-item @if (Route::is('dashboard')) active @endif">
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <span>@lang('Dashboard')</span>
                </a>
            </li>

            <li class="nav-item @if (Route::is('education.*')) active @endif">
                <a href="{{ route('education.index') }}" class="nav-link">
                    <span>@lang('Educate')</span>
                </a>
            </li>

            <li class="nav-item @if (Route::is('monitoring.*')) active @endif">
                <a href="{{ route('monitoring.index') }}" class="nav-link">
                    <span>@lang('Monitoring')</span>
                </a>
            </li>

            <li class="nav-item @if (Route::is('achievement.*')) active @endif">
                <a href="{{ route('achievement.index') }}" class="nav-link">
                    <span>@lang('Achievement')</span>
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
