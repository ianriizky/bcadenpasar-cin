@extends('layouts.admin')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>@lang('Show :name', ['name' => __('menu.target')])</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                    <a href="{{ route('monitoring.index') }}">
                        <i class="fas @lang('icon.monitoring')"></i> <span>@lang('menu.monitoring')</span>
                    </a>
                </div>

                <div class="breadcrumb-item">
                    <a href="{{ route('monitoring.target.index') }}">
                        <i class="fas @lang('icon.target')"></i> <span>@lang('menu.target')</span>
                    </a>
                </div>

                <div class="breadcrumb-item">
                    <a href="{{ route('monitoring.target.show', $target) }}">
                        <i class="fas fa-eye"></i> <span>@lang('Show :name', ['name' => __('menu.target')])</span>
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

                            <p class="form-control-plaintext">{{ $target->branch->name }}</p>
                        </div>
                        {{-- /.branch_id --}}

                        <div class="col-12 col-lg-6"></div>

                        {{-- periodicity --}}
                        <div class="form-group col-12 col-lg-6">
                            <label for="periodicity">@lang('Periodicity')</label>

                            <p class="form-control-plaintext">{{ $target->periodicity->label }}</p>
                        </div>
                        {{-- /.periodicity --}}

                        {{-- start_date && end_date --}}
                        <div class="form-group col-12 col-lg-6">
                            <label for="name">@lang('Start Date') & @lang('End Date')</label>

                            <p class="form-control-plaintext">{{ $target->start_date_end_date_iso_format }}</p>
                        </div>
                        {{-- /.start_date && end_date --}}

                        {{-- amount --}}
                        <div class="form-group col-12 col-lg-6">
                            <label for="amount">@lang('Amount')</label>

                            <p class="form-control-plaintext">{{ $target->getRawAttribute('amount') }}</p>
                        </div>
                        {{-- /.amount --}}

                        {{-- note --}}
                        <div class="form-group col-12 col-lg-6">
                            <label for="note">@lang('Note')</label>

                            <p class="form-control-plaintext">{{ $target->note }}</p>
                        </div>
                        {{-- /.note --}}
                    </div>

                    @include('components.form-timestamps', ['model' => $target])
                </div>

                <div class="card-footer">
                    @can('viewAny', \App\Models\Target::class)
                        @include('components.datatables.link-back', ['url' => route('monitoring.target.index')])
                    @endcan

                    @can('update', $target)
                        @include('components.datatables.link-edit', ['url' => route('monitoring.target.edit', $target)])
                    @endcan
                </div>
            </div>
        </div>
    </section>
@endsection
