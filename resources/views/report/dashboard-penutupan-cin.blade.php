@extends('layouts.admin')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Dashboard Penutupan CiN {{ $period }}</h1>

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
            <div class="row">
                @foreach (\App\Enum\Periodicity::toArray() as $value => $label)
                    <div class="col-12 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Target {{ $label }} VS Capaian NEW CiN</h4>
                            </div>

                            <div class="card-body">
                                <button id="download-table" class="btn btn-icon icon-left btn-success">
                                    <i class="fa fa-download"></i> <span>@lang('Download')</span>
                                </button>

                                <div class="table-responsive mt-3">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col" style="width: 5%;">No.</th>
                                                <th scope="col">@lang('menu.branch')</th>
                                                <th scope="col">@lang('menu.target') ({{ $label }})</th>
                                                <th scope="col">@lang('menu.achievement')</th>
                                                <th scope="col">@lang('Pipeline')</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($branches as $branchId => $branchName)
                                                <tr>
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <td>{{ $branchName }}</td>
                                                    <td>{{ data_get($targets, $value . '.' . $branchId, 0) }}</td>
                                                    <td>{{ data_get($achievements, $value . '.' . $branchId, 0) }}</td>
                                                    <td></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
