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
                    <div class="row justify-content-center">
                        {{-- inputachievement --}}
                        <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                            <article class="article">
                                <div class="article-header">
                                    <div class="article-image" data-background="{{ gravatar_image(null, 200) }}"></div>

                                    <div class="article-title">
                                        <h2>
                                            <a href="{{ route('monitoring.achievement.index') }}">@lang('menu.achievement')</a>
                                        </h2>
                                    </div>
                                </div>

                                <div class="article-details">
                                    <p>
                                        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                                    </p>

                                    <div class="article-cta">
                                        <a href="{{ route('monitoring.achievement.index') }}" class="btn btn-primary">@lang('View')</a>
                                    </div>
                                </div>
                            </article>
                        </div>
                        {{-- /.achievement --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
