@push('styles')
    <style>
        span.narrow-line-height {
            line-height: 15px !important;
        }
        @media (max-width: 1024px) {
            ul.dropdown-submenu {
                position: relative;
            }
            ul.dropdown-submenu > ul.dropdown-menu {
                top: 0;
                left: 100%;
                margin-top: -6px;
                margin-left: -1px;
            }
            ul.dropdown-submenu:hover > ul.dropdown-menu {
                display: block;
            }
            ul.dropdown-submenu:hover > a:after {
                border-left-color: #fff;
            }
            ul.dropdown-submenu.pull-left {
                float: none;
            }
            ul.dropdown-submenu.pull-left > ul.dropdown-menu {
                left: -100%;
                margin-left: 10px;
            }
        }
    </style>
@endpush

<nav class="navbar navbar-secondary navbar-expand-lg">
    <div class="container">
        <ul class="navbar-nav">
            <li class="nav-item dropdown @if (Route::is('education.*')) active @endif">
                <a href="#" data-toggle="dropdown" class="nav-link has-dropdown">
                    <i class="fas @lang('icon.education')"></i> <span>@lang('Educate')</span>
                </a>

                <ul class="dropdown-menu">
                    <li class="nav-item dropdown">
                        <a href="#" data-toggle="dropdown" class="nav-link has-dropdown">
                            <span class="narrow-line-height">Webinar Literasi Keuangan</span>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-mobile" data-dropdown-menu-mobile-class="dropdown-submenu">
                            <li class="nav-item mb-xl-0 mb-4">
                                <a href="#" class="nav-link">
                                    <span class="narrow-line-height">Template Surat Penawaran Webinar</span>
                                </a>
                            </li>

                            <li class="nav-item mb-xl-0 mb-4">
                                <a href="#" class="nav-link">
                                    <span class="narrow-line-height">Template Presentasi Webinar Literasi Keuangan</span>
                                </a>
                            </li>

                            <li class="nav-item mb-xl-0 mb-4">
                                <a href="#" class="nav-link">
                                    <span class="narrow-line-height">Template Rundown Webinar Literasi Keuangan</span>
                                </a>
                            </li>

                            <li class="nav-item mb-xl-0 mb-4">
                                <a href="#" class="nav-link">
                                    <span class="narrow-line-height">Pemetaan Sekolah / Kampus Potensi Webinar</span>
                                </a>
                            </li>

                            <li class="nav-item mb-xl-0 mb-4">
                                <a href="#" class="nav-link">
                                    <span class="narrow-line-height">Input Rencana Penyelenggaraan Webinar</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <span class="narrow-line-height">Video Pembukaan Rekening Online</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <span class="narrow-line-height">Employee Get CiN</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item dropdown @if (Route::is('monitoring.*')) active @endif">
                <a href="#" data-toggle="dropdown" class="nav-link has-dropdown">
                    <i class="fas @lang('icon.monitoring')"></i> <span>@lang('Monitoring')</span>
                </a>

                <ul class="dropdown-menu">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <span class="narrow-line-height">Input Pencapaian Harian</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item dropdown @if (Route::is('achievement.*')) active @endif">
                <a href="#" data-toggle="dropdown" class="nav-link has-dropdown">
                    <i class="fas @lang('icon.achievement')"></i> <span>@lang('Achievement')</span>
                </a>

                <ul class="dropdown-menu">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <span class="narrow-line-height">Dashboard Pencapaian</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <span class="narrow-line-height">Dashboard Growth New CiN</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <span class="narrow-line-height">Dashboard Penutupan CiN</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
