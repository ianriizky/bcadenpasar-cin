@extends('layouts.admin')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>@lang('menu.monitoring')</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                    <a href="{{ route('monitoring.index') }}">
                        <i class="fas @lang('icon.monitoring')"></i> <span>@lang('menu.monitoring')</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        {{-- input-pencapaian-harian --}}
                        <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                            <article class="article">
                                <div class="article-header">
                                    <div class="article-image" data-background="https://www.gravatar.com/avatar/"></div>

                                    <div class="article-title">
                                        <h2>
                                            <a href="{{ route('monitoring.create') }}">Input Pencapaian Harian</a>
                                        </h2>
                                    </div>
                                </div>

                                <div class="article-details">
                                    <p>
                                        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                                    </p>

                                    <div class="article-cta">
                                        <a href="{{ route('monitoring.create') }}" class="btn btn-primary">@lang('New')</a>
                                    </div>
                                </div>
                            </article>
                        </div>
                        {{-- /.input-pencapaian-harian --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
