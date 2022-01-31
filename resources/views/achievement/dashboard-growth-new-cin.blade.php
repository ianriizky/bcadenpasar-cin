@extends('layouts.admin')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Dashboard Growth New CiN</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                    <a href="{{ route('achievement.index') }}">
                        <i class="fas @lang('icon.achievement')"></i> <span>@lang('menu.achievement')</span>
                    </a>
                </div>

                <div class="breadcrumb-item">
                    <a href="{{ route('achievement.dashboard-growth-new-cin') }}">
                        <span>Dashboard Growth New CiN</span>
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
