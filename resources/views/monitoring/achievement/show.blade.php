@extends('layouts.admin')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>@lang('Show :name', ['name' => __('menu.achievement')])</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                    <a href="{{ route('monitoring.index') }}">
                        <i class="fas @lang('icon.monitoring')"></i> <span>@lang('menu.monitoring')</span>
                    </a>
                </div>

                <div class="breadcrumb-item">
                    <a href="{{ route('monitoring.achievement.index') }}">
                        <i class="fas @lang('icon.achievement')"></i> <span>@lang('menu.achievement')</span>
                    </a>
                </div>

                <div class="breadcrumb-item">
                    <a href="{{ route('monitoring.achievement.show', $achievement) }}">
                        <i class="fas fa-eye"></i> <span>@lang('Show :name', ['name' => __('menu.achievement')])</span>
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

                            <p class="form-control-plaintext">{{ $achievement->target->branch->name }}</p>
                        </div>
                        {{-- /.branch_id --}}

                        <div class="col-12 col-lg-6"></div>

                        {{-- target_id --}}
                        <div class="form-group col-12 col-lg-6">
                            <label for="target_id">@lang('menu.target')</label>

                            <p class="form-control-plaintext">{{ $achievement->target->name }}</p>
                        </div>
                        {{-- /.target_id --}}

                        {{-- event_id --}}
                        <div class="form-group col-12 col-lg-6">
                            <label for="event_id">@lang('menu.event')</label>

                            <p class="form-control-plaintext">{{ optional($achievement->event)->name }}</p>
                        </div>
                        {{-- /.event_id --}}

                        {{-- achieved_date --}}
                        <div class="form-group col-12 col-lg-6">
                            <label for="achieved_date">@lang('Achieved Date')</label>

                            <p class="form-control-plaintext">{{ $achievement->achieved_date_iso_format }}</p>
                        </div>
                        {{-- /.achieved_date --}}

                        {{-- achieved_by --}}
                        <div class="form-group col-12 col-lg-6">
                            <label for="achieved_by">@lang('Achieved Date')</label>

                            <p class="form-control-plaintext">{{ $achievement->achievedBy->name }}</p>
                        </div>
                        {{-- /.achieved_by --}}

                        {{-- amount --}}
                        <div class="form-group col-12 col-lg-6">
                            <label for="amount">@lang('Amount')</label>

                            <p class="form-control-plaintext">{{ $achievement->getRawAttribute('amount') }}</p>
                        </div>
                        {{-- /.amount --}}

                        {{-- note --}}
                        <div class="form-group col-12 col-lg-6">
                            <label for="note">@lang('Note')</label>

                            <p class="form-control-plaintext">{{ $achievement->note }}</p>
                        </div>
                        {{-- /.note --}}
                    </div>

                    @include('components.form-timestamps', ['model' => $achievement])
                </div>

                <div class="card-footer">
                    @can('viewAny', \App\Models\Achievement::class)
                        @include('components.datatables.link-back', ['url' => route('monitoring.achievement.index')])
                    @endcan

                    @can('update', $achievement)
                        @include('components.datatables.link-edit', ['url' => route('monitoring.achievement.edit', $achievement)])
                    @endcan
                </div>
            </div>
        </div>
    </section>
@endsection
