@extends('layouts.admin')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>@lang('Create') @lang('menu.achievement')</h1>

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
                    <a href="{{ route('monitoring.achievement.create') }}">
                        <span>@lang('Create')</span>
                    </a>
                </div>
            </div>
        </div>

        <form action="">
            @csrf

            <div class="section-body">
                <div class="card">
                    <div class="card-body">

                    </div>
                </div>
            </div>
        </form>
    </section>
@endsection
