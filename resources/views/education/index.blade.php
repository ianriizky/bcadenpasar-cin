@extends('layouts.admin')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>@lang('Educate')</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                    <span>@lang('Menu')</span>
                </div>

                <div class="breadcrumb-item">
                    <a href="{{ route('education.index') }}">
                        <i class="fas @lang('icon.education')"></i> <span>@lang('Educate')</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <p>@lang('Welcome to the educate page!')</p>
                </div>
            </div>
        </div>
    </section>
@endsection
