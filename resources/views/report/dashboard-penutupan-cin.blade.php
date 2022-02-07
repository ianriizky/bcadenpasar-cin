@extends('layouts.admin')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Dashboard Penutupan CiN</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                    <a href="{{ route('report.index') }}">
                        <i class="fas @lang('icon.achievement')"></i> <span>@lang('menu.achievement')</span>
                    </a>
                </div>

                <div class="breadcrumb-item">
                    <a href="{{ route('report.dashboard-penutupan-cin.index') }}">
                        <span>Dashboard Penutupan CiN</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">

                </div>
            </div>
        </div>
    </section>
@endsection
