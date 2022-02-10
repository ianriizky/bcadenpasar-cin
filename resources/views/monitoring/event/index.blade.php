@extends('layouts.admin')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>@lang('menu.event')</h1>

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
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('monitoring.event.create') }}" class="btn btn-success">
                        <i class="fas fa-plus-square"></i> <span>@lang('Create')</span>
                    </a>
                </div>

                <div class="card-body">

                </div>
            </div>
        </div>
    </section>
@endsection
