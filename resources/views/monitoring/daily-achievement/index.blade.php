@extends('layouts.admin')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Input Pencapaian Harian</h1>

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
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('monitoring.daily-achievement.create') }}" class="btn btn-success">
                        <i class="fas fa-plus-square"></i> <span>@lang('Create')</span>
                    </a>
                </div>

                <div class="card-body">
                    Halaman Input Pencapaian Harian
                </div>
            </div>
        </div>
    </section>
@endsection
