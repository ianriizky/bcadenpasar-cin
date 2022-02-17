@extends('layouts.admin')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>@lang('Show :name', ['name' => __('menu.user')])</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                    <a href="{{ route('master.index') }}">
                        <i class="fas @lang('icon.master')"></i> <span>@lang('menu.master')</span>
                    </a>
                </div>

                <div class="breadcrumb-item">
                    <a href="{{ route('master.user.index') }}">
                        <i class="fas @lang('icon.user')"></i> <span>@lang('menu.user')</span>
                    </a>
                </div>

                <div class="breadcrumb-item">
                    <a href="{{ route('master.user.show', $user) }}">
                        <i class="fas fa-eye"></i> <span>@lang('Show :name', ['name' => __('menu.user')])</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        {{-- branch_id --}}
                        <div class="form-group col-12 col-lg-6">
                            <label for="branch_id">@lang('menu.branch')</label>

                            <p class="form-control-plaintext">{{ $user->branch->name }}</p>
                        </div>
                        {{-- /.branch_id --}}

                        <div class="col-12 col-lg-6"></div>

                        {{-- username --}}
                        <div class="form-group col-12 col-lg-6">
                            <label for="username">Username</label>

                            <p class="form-control-plaintext">{{ $user->username }}</p>
                        </div>
                        {{-- /.username --}}

                        {{-- name --}}
                        <div class="form-group col-12 col-lg-6">
                            <label for="name">@lang('Name')</label>

                            <p class="form-control-plaintext">{{ $user->name }}</p>
                        </div>
                        {{-- /.name --}}

                        {{-- email --}}
                        <div class="form-group col-12 col-lg-6">
                            <label for="email">@lang('Email')</label>

                            <p class="form-control-plaintext">{{ $user->email }}</p>
                        </div>
                        {{-- /.email --}}

                        {{-- role --}}
                        <div class="form-group col-12 col-lg-6">
                            <label for="role">@lang('Role')</label>

                            <p class="form-control-plaintext">{{ $user->role }}</p>
                        </div>
                        {{-- /.role --}}

                        {{-- email_verified_at --}}
                        <div class="form-group col-12 col-lg-6">
                            <label for="email_verified_at">@lang('Verify Email Address')</label>

                            <p class="form-control-plaintext">
                                {{ $user->email_verified_at->isoFormat('DD MMMM YYYY HH:mm:ss') }}
                            </p>
                        </div>
                        {{-- /.email_verified_at --}}
                    </div>

                    @include('components.form-timestamps', ['model' => $user])
                </div>

                <div class="card-footer">
                    @can('viewAny', \App\Models\User::class)
                        @include('components.datatables.link-back', ['url' => route('master.user.index')])
                    @endcan

                    @can('update', $user)
                        @include('components.datatables.link-edit', ['url' => route('master.user.edit', $user)])
                    @endcan
                </div>
            </div>
        </div>
    </section>
@endsection
