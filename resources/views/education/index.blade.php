@extends('layouts.admin')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>@lang('menu.education')</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                    <a href="{{ route('education.index') }}">
                        <i class="fas @lang('icon.education')"></i> <span>@lang('menu.education')</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        {{-- webinar-literasi-keuangan --}}
                        <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                            <article class="article">
                                <div class="article-header">
                                    <div class="article-image" data-background="https://www.gravatar.com/avatar/"></div>

                                    <div class="article-title">
                                        <h2>
                                            <a href="{{ route('education.webinar-literasi-keuangan.index') }}">Webinar Literasi Keuangan</a>
                                        </h2>
                                    </div>
                                </div>

                                <div class="article-details">
                                    <p>
                                        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                                    </p>

                                    <div class="article-cta">
                                        <a href="{{ route('education.webinar-literasi-keuangan.index') }}" class="btn btn-primary">@lang('Read More')</a>
                                    </div>
                                </div>
                            </article>
                        </div>
                        {{-- /.webinar-literasi-keuangan --}}

                        {{-- pembukaan-rekening-online --}}
                        <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                            <article class="article">
                                <div class="article-header">
                                    <div class="article-image" data-background="https://www.gravatar.com/avatar/"></div>

                                    <div class="article-title">
                                        <h2>
                                            <a href="{{ route('education.pembukaan-rekening-online.index') }}">Video Pembukaan Rekening Online</a>
                                        </h2>
                                    </div>
                                </div>

                                <div class="article-details">
                                    <p>
                                        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                                    </p>

                                    <div class="article-cta">
                                        <a href="{{ route('education.pembukaan-rekening-online.index') }}" class="btn btn-primary">@lang('Read More')</a>
                                    </div>
                                </div>
                            </article>
                        </div>
                        {{-- /.pembukaan-rekening-online --}}

                        {{-- employee-get-cin --}}
                        <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                            <article class="article">
                                <div class="article-header">
                                    <div class="article-image" data-background="https://www.gravatar.com/avatar/"></div>

                                    <div class="article-title">
                                        <h2>
                                            <a href="{{ route('education.employee-get-cin.index') }}">Employee Get CiN</a>
                                        </h2>
                                    </div>
                                </div>

                                <div class="article-details">
                                    <p>
                                        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                                    </p>

                                    <div class="article-cta">
                                        <a href="{{ route('education.employee-get-cin.index') }}" class="btn btn-primary">@lang('Read More')</a>
                                    </div>
                                </div>
                            </article>
                        </div>
                        {{-- /.employee-get-cin --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
