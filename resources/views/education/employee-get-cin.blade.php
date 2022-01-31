@extends('layouts.admin')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Employee Get CiN</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                    <a href="{{ route('education.index') }}">
                        <i class="fas @lang('icon.education')"></i> <span>@lang('menu.education')</span>
                    </a>
                </div>

                <div class="breadcrumb-item">
                    <a href="{{ route('education.pembukaan-rekening-online') }}">
                        <span>Employee Get CiN</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    Halaman Employee Get CiN
                </div>
            </div>
        </div>
    </section>
@endsection
