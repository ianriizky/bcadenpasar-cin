@extends('layouts.admin')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>@lang('Show :name', ['name' => __('menu.event')])</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                    <a href="{{ route('monitoring.index') }}">
                        <i class="fas @lang('icon.monitoring')"></i> <span>@lang('menu.monitoring')</span>
                    </a>
                </div>

                <div class="breadcrumb-item">
                    <a href="{{ route('monitoring.event.index') }}">
                        <i class="fas @lang('icon.event')"></i> <span>@lang('menu.event')</span>
                    </a>
                </div>

                <div class="breadcrumb-item">
                    <a href="{{ route('monitoring.event.show', $event) }}">
                        <i class="fas fa-eye"></i> <span>@lang('Show :name', ['name' => __('menu.event')])</span>
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

                            <p class="form-control-plaintext">{{ $event->branch->name }}</p>
                        </div>
                        {{-- /.branch_id --}}

                        <div class="col-12 col-lg-6"></div>

                        {{-- name --}}
                        <div class="form-group col-12 col-lg-6">
                            <label for="name">@lang('Name')</label>

                            <p class="form-control-plaintext">{{ $event->name }}</p>
                        </div>
                        {{-- /.name --}}

                        {{-- date --}}
                        <div class="form-group col-12 col-lg-6">
                            <label for="name">@lang('Date')</label>

                            <p class="form-control-plaintext">{{ $event->date_iso_format }}</p>
                        </div>
                        {{-- /.date --}}

                        {{-- location --}}
                        <div class="form-group col-12 col-lg-6">
                            <label for="location">@lang('Location')</label>

                            <p class="form-control-plaintext">{{ $event->location }}</p>
                        </div>
                        {{-- /.location --}}

                        {{-- note --}}
                        <div class="form-group col-12 col-lg-6">
                            <label for="note">@lang('Note')</label>

                            <p class="form-control-plaintext">{{ $event->note }}</p>
                        </div>
                        {{-- /.note --}}
                    </div>

                    @include('components.form-timestamps', ['model' => $event])
                </div>

                <div class="card-footer">
                    @can('viewAny', \App\Models\Event::class)
                        @include('components.datatables.link-back', ['url' => route('monitoring.event.index')])
                    @endcan

                    @can('update', $event)
                        @include('components.datatables.link-edit', ['url' => route('monitoring.event.edit', $event)])
                    @endcan
                </div>
            </div>
        </div>
    </section>
@endsection
