@extends('layouts.admin')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>@lang('Create') Input Pencapaian Harian</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                    <a href="{{ route('monitoring.index') }}">
                        <i class="fas @lang('icon.monitoring')"></i> <span>@lang('menu.monitoring')</span>
                    </a>
                </div>

                <div class="breadcrumb-item">
                    <a href="{{ route('monitoring.daily-achievement.index') }}">
                        <span>Input Pencapaian Harian</span>
                    </a>
                </div>

                <div class="breadcrumb-item">
                    <a href="{{ route('monitoring.daily-achievement.create') }}">
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
