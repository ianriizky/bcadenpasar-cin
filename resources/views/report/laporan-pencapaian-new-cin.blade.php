@extends('layouts.admin')

@section('style')
    <link rel="stylesheet" href="{{ mix('node_modules/bootstrap-daterangepicker/daterangepicker.css') }}">
@endsection

@section('script')
    <script src="{{ mix('node_modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ mix('node_modules/chart.js/dist/chart.min.js') }}"></script>
    <script src="{{ mix('node_modules/chartjs-plugin-datalabels/dist/chartjs-plugin-datalabels.min.js') }}"></script>
    <script>
        const initialStartDate = moment().startOf('days');
        const initialEndDate = moment().endOf('days');
        const initialPeriodicity = @json(\App\Enum\Periodicity::daily());

        const applyLabel = '@lang('Apply')';
        const cancelLabel = '@lang('Cancel')';
        const customRangeLabel = '@lang('Choose date')';
        const periodicityLabel = '@lang('Choose :field', ['field' => __('Periodicity') ])';
        const xAxesTitleText = @json(strtoupper(__('menu.branch')));
        const daterangepickerRanges = {
            '@lang('Today')': [initialStartDate.clone(), initialEndDate.clone()],
            '@lang('Yesterday')': [initialStartDate.clone().subtract(1, 'days'), initialEndDate.clone().subtract(1, 'days')],
            '@lang('Last 7 Days')': [initialStartDate.clone().subtract(6, 'days'), initialEndDate.clone()],
            '@lang('Last 30 Days')': [initialStartDate.clone().subtract(29, 'days'), initialEndDate.clone()],
            '@lang('This Month')': [initialStartDate.clone().startOf('month'), initialEndDate.clone().endOf('month')],
            '@lang('Last Month')': [initialStartDate.clone().subtract(1, 'month').startOf('month'), initialEndDate.clone().subtract(1, 'month').endOf('month')],
            '@lang('This Year')': [initialStartDate.clone().startOf('year'), initialEndDate.clone().endOf('year')],
        };
    </script>
    <script src="{{ mix('js/page/report/laporan-pencapaian-new-cin.js') }}"></script>
    <script>
        $(function () {
            $('button#load-chart-data').trigger('click');
            $(`a.periodicity-dropdown-item[data-value=${initialPeriodicity}]`).trigger('click');
        });
    </script>
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Laporan Pencapaian New CiN</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                    <a href="{{ route('report.index') }}">
                        <i class="fas @lang('icon.report')"></i> <span>@lang('menu.report')</span>
                    </a>
                </div>

                <div class="breadcrumb-item">
                    <a href="{{ route('report.laporan-pencapaian-new-cin.index') }}">
                        <span>Laporan Pencapaian New CiN</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Jumlah New CiN dan Target Bulanan</h4>

                    <div class="card-header-action">
                        <button id="download-chart" class="btn btn-block btn-icon icon-left btn-success">
                            <i class="fa fa-download"></i> <span>@lang('Download')</span>
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-lg-8 offset-lg-4">
                            <div class="btn-group btn-block">
                                <button class="btn btn-outline-primary btn-icon icon-left btn-daterange">
                                    <i class="fa fa-calendar"></i> <span>@lang('Choose date')</span>
                                </button>

                                <button type="button"
                                    id="periodicity-dropdown-toggle"
                                    class="btn btn-outline-primary dropdown-toggle"
                                    data-toggle="dropdown"
                                    style="border-top-right-radius: 0; border-bottom-right-radius: 0;"
                                    aria-haspopup="true"
                                    aria-expanded="false">
                                    @lang('Choose :field', ['field' => __('Periodicity') ])
                                </button>

                                <div class="dropdown-menu">
                                    @foreach (\App\Enum\Periodicity::toArray() as $value => $label)
                                        <a class="dropdown-item periodicity-dropdown-item" style="cursor: pointer;" data-value="{{ $value }}">{{ $label }}</a>
                                    @endforeach

                                    <div class="dropdown-divider"></div>

                                    <a class="dropdown-item has-icon periodicity-dropdown-item" style="cursor: pointer;" data-value="__reset">
                                        <i class="far fa-trash-alt"></i> <span>@lang('Reset Filters')</span>
                                    </a>
                                </div>

                                <button type="button" id="load-chart-data" data-url="{{ route('report.laporan-pencapaian-new-cin.chart') }}" class="btn btn-primary btn-icon icon-left col-2 col-lg-3">
                                    <i class="fa fa-search"></i> <span class="d-none d-lg-inline">@lang('Search')</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3 position-relative min-vh-100">
                        <canvas id="chart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
