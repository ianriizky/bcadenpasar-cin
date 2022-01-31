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
                Copyright &copy; {{ config('app.name') }} 2022

                <span class="d-none d-lg-inline">
                    <div class="bullet"></div>

                    Design By <a href="https://nauval.in/">Muhamad Nauval Azhar</a>

                    <div class="bullet"></div>

                    <a href="https://instagram.com" target="_blank">
                        <i class="fab fa-instagram"></i>
                    </a>

                    <a href="https://facebook.com" target="_blank">
                        <i class="fab fa-facebook"></i>
                    </a>

                    <a href="https://twitter.com" target="_blank">
                        <i class="fab fa-twitter"></i>
                    </a>
                </span>
            </div>

            <div class="footer-right d-none d-lg-block">
                {{ config('app.name') }}
            </div>
        </footer>
    </div>
@endcomponent
