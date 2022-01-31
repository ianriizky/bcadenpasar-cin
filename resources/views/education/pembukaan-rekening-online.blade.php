@extends('layouts.admin')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Video Pembukaan Rekening Online</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                    <a href="{{ route('education.index') }}">
                        <i class="fas @lang('icon.education')"></i> <span>@lang('menu.education')</span>
                    </a>
                </div>

                <div class="breadcrumb-item">
                    <a href="{{ route('education.pembukaan-rekening-online') }}">
                        <span>Video Pembukaan Rekening Online</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    Halaman Video Pembukaan Rekening Online
                </div>
            </div>
        </div>
    </section>
@endsection
