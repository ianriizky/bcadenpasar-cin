@extends('layouts.admin')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Template Surat Penawaran Webinar</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                    <a href="{{ route('education.index') }}">
                        <i class="fas @lang('icon.education')"></i> <span>@lang('menu.education')</span>
                    </a>
                </div>

                <div class="breadcrumb-item">
                    <a href="{{ route('education.webinar-literasi-keuangan.index') }}">
                        <span>Webinar Literasi Keuangan</span>
                    </a>
                </div>

                <div class="breadcrumb-item">
                    <a href="{{ route('education.webinar-literasi-keuangan.template-surat-penawaran-webinar') }}">
                        <span>Template Surat Penawaran Webinar</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <p>Halaman Template Surat Penawaran Webinar</p>
                </div>
            </div>
        </div>
    </section>
@endsection
