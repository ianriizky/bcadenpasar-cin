@extends('layouts.admin')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>@lang('menu.master')</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                    <a href="{{ route('master.index') }}">
                        <i class="fas @lang('icon.master')"></i> <span>@lang('menu.master')</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-center">
                        {{-- branch --}}
                        @can('viewAny', \App\Models\Branch::class)
                            <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                                <article class="article">
                                    <div class="article-header">
                                        <div class="article-image" data-background="{{ gravatar_image(null, 200) }}"></div>

                                        <div class="article-title">
                                            <h2>
                                                <a href="{{ route('master.branch.index') }}">@lang('menu.branch')</a>
                                            </h2>
                                        </div>
                                    </div>

                                    <div class="article-details">
                                        <p>
                                            Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                                        </p>

                                        <div class="article-cta">
                                            <a href="{{ route('master.branch.index') }}" class="btn btn-primary">@lang('View')</a>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        @endcan
                        {{-- /.branch --}}

                        {{-- user --}}
                        @can('viewAny', \App\Models\User::class)
                            <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                                <article class="article">
                                    <div class="article-header">
                                        <div class="article-image" data-background="{{ gravatar_image(null, 200) }}"></div>

                                        <div class="article-title">
                                            <h2>
                                                <a href="{{ route('master.user.index') }}">@lang('menu.user')</a>
                                            </h2>
                                        </div>
                                    </div>

                                    <div class="article-details">
                                        <p>
                                            Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                                        </p>

                                        <div class="article-cta">
                                            <a href="{{ route('master.user.index') }}" class="btn btn-primary">@lang('View')</a>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        @endcan
                        {{-- /.user --}}

                        {{-- role --}}
                        @can('viewAny', \App\Models\Role::class)
                            <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                                <article class="article">
                                    <div class="article-header">
                                        <div class="article-image" data-background="{{ gravatar_image(null, 200) }}"></div>

                                        <div class="article-title">
                                            <h2>
                                                <a href="{{ route('master.role.index') }}">@lang('menu.role')</a>
                                            </h2>
                                        </div>
                                    </div>

                                    <div class="article-details">
                                        <p>
                                            Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                                        </p>

                                        <div class="article-cta">
                                            <a href="{{ route('master.role.index') }}" class="btn btn-primary">@lang('View')</a>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        @endcan
                        {{-- /.role --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
