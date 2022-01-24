<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('dashboard') }}">{{ config('app.name') }}</a>
        </div>

        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('dashboard') }}">{{ config('app.shortname') }}</a>
        </div>

        <ul class="sidebar-menu">
            <li class="menu-header">@lang('Home')</li>

            <li @if (Route::is('dashboard')) class="active" @endif>
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <i class="fa fa-fire"></i> <span>@lang('Dashboard')</span>
                </a>
            </li>
        </ul>
    </aside>
</div>
