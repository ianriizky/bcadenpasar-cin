@extends('layouts.admin')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>@lang('Dashboard')</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                    <span>@lang('Home')</span>
                </div>

                <div class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">
                        <i class="fas @lang('icon.dashboard')"></i> <span>@lang('Dashboard')</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <p>@lang('Welcome to the dashboard page!')</p>
                </div>
            </div>
        </div>
    </section>
@endsection
