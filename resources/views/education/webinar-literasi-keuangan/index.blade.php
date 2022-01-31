@extends('layouts.admin')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Webinar Literasi Keuangan</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                    <a href="{{ route('education.index') }}">
                        <i class="fas @lang('icon.education')"></i> <span>@lang('menu.education')</span>
                    </a>
                </div>

                <div class="breadcrumb-item">
                    <a href="{{ route('education.webinar-literasi-keuangan.index') }}">
                        <span>Webinar Literasi Keuangan</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    {{-- first-row --}}
                    <div class="row justify-content-center">
                        {{-- template-surat-penawaran-webinar --}}
                        <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                            <div class="alert alert-primary alert-has-icon">
                                <div class="alert-icon"><i class="fas fa-envelope-open-text"></i></div>

                                <div class="alert-body">
                                    <div class="alert-title">Template Surat Penawaran Webinar</div>

                                    <a href="{{ route('education.webinar-literasi-keuangan.template-surat-penawaran-webinar') }}">@lang('Download Here')</a>
                                </div>
                            </div>
                        </div>
                        {{-- /.template-surat-penawaran-webinar --}}

                        {{-- template-presentasi-webinar-literasi-keuangan --}}
                        <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                            <div class="alert alert-primary alert-has-icon">
                                <div class="alert-icon"><i class="fas fa-file-powerpoint"></i></div>

                                <div class="alert-body">
                                    <div class="alert-title">Template Presentasi Webinar Literasi Keuangan</div>

                                    <a href="{{ route('education.webinar-literasi-keuangan.template-presentasi-webinar-literasi-keuangan') }}">@lang('Download Here')</a>
                                </div>
                            </div>
                        </div>
                        {{-- /.template-presentasi-webinar-literasi-keuangan --}}

                        {{-- template-rundown-webinar-literasi-keuangan --}}
                        <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                            <div class="alert alert-primary alert-has-icon">
                                <div class="alert-icon"><i class="fas fa-clock"></i></div>

                                <div class="alert-body">
                                    <div class="alert-title">Template Rundown Webinar Literasi Keuangan</div>

                                    <a href="{{ route('education.webinar-literasi-keuangan.template-rundown-webinar-literasi-keuangan') }}">@lang('Download Here')</a>
                                </div>
                            </div>
                        </div>
                        {{-- /.template-rundown-webinar-literasi-keuangan --}}
                    </div>
                    {{-- /.first-row --}}

                    {{-- second-row --}}
                    <div class="row justify-content-center">
                        {{-- pemetaan-sekolah-kampus-potensi-webinar --}}
                        <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                            <div class="alert alert-primary alert-has-icon">
                                <div class="alert-icon"><i class="fas fa-map-marker-alt"></i></div>

                                <div class="alert-body">
                                    <div class="alert-title">Pemetaan Sekolah / Kampus Potensi Webinar</div>

                                    <a href="{{ route('education.webinar-literasi-keuangan.pemetaan-sekolah-kampus-potensi-webinar') }}">@lang('Download Here')</a>
                                </div>
                            </div>
                        </div>
                        {{-- /.pemetaan-sekolah-kampus-potensi-webinar --}}

                        {{-- input-rencana-penyelenggaraan-webinar --}}
                        <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                            <div class="alert alert-primary alert-has-icon">
                                <div class="alert-icon"><i class="fas fa-laptop"></i></div>

                                <div class="alert-body">
                                    <div class="alert-title">Input Rencana Penyelenggaraan Webinar</div>

                                    <a href="{{ route('education.webinar-literasi-keuangan.input-rencana-penyelenggaraan-webinar') }}">@lang('Download Here')</a>
                                </div>
                            </div>
                        </div>
                        {{-- /.input-rencana-penyelenggaraan-webinar --}}
                    </div>
                    {{-- /.second-row --}}
                </div>
            </div>
        </div>
    </section>
@endsection
