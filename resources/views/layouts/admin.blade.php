@section('masterBodyClass', 'layout-3')

@component('layouts.master')
    <div class="main-wrapper container">
        <div class="navbar-bg"></div>

        @include('components.header')

        @include('components.sidebar')

        <div class="main-content">
            @includeWhen($alert = session('alert'), 'components.alert-dismissible', compact('alert'))

            @isset($slot)
                {{ $slot }}
            @else
                @hasSection ('content')
                    @yield('content')
                @endif
            @endisset
        </div>

        <footer class="main-footer">
            <div class="footer-left">
                Copyright &copy; {{ config('app.name') }} 2022 <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad Nauval Azhar</a>
            </div>

            <div class="footer-right">
                {{ config('app.name') }}
            </div>
        </footer>
    </div>
@endcomponent
