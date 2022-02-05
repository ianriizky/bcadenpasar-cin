@extends('layouts.admin')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>@lang('Show :name', ['name' => __('menu.branch')])</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                    <a href="{{ route('master.index') }}">
                        <i class="fas @lang('icon.master')"></i> <span>@lang('menu.master')</span>
                    </a>
                </div>

                <div class="breadcrumb-item">
                    <a href="{{ route('master.branch.index') }}">
                        <i class="fas @lang('icon.branch')"></i> <span>@lang('menu.branch')</span>
                    </a>
                </div>

                <div class="breadcrumb-item">
                    <a href="{{ route('master.branch.show', $branch) }}">
                        <i class="fas fa-eye"></i> <span>@lang('Show :name', ['name' => __('menu.branch')])</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        {{-- name --}}
                        <div class="form-group col-12 col-lg-6">
                            <label for="name">@lang('Name')</label>

                            <p class="form-control-plaintext">{{ $branch->name }}</p>
                        </div>
                        {{-- /.name --}}

                        <div class="col-12 col-lg-6"></div>

                        {{-- address --}}
                        <div class="form-group col-12 col-lg-6">
                            <label for="address">@lang('Address')</label>

                            <p class="form-control-plaintext">{{ $branch->address }}</p>
                        </div>
                        {{-- /.address --}}
                    </div>

                    @include('components.form-timestamps', ['model' => $branch])
                </div>

                <div class="card-footer">
                    @can('viewAny', \App\Models\Branch::class)
                        @include('components.datatables.link-back', ['url' => route('master.branch.index')])
                    @endcan

                    @can('update', $branch)
                        @include('components.datatables.link-edit', ['url' => route('master.branch.edit', $branch)])
                    @endcan
                </div>
            </div>
        </div>
    </section>
@endsection
