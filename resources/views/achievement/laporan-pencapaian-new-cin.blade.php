@extends('layouts.admin')

@section('style')
    <link rel="stylesheet" href="{{ mix('node_modules/bootstrap-daterangepicker/daterangepicker.css') }}">
@endsection

@section('script')
    <script src="{{ mix('node_modules/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ mix('node_modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script>
        let startDate = moment().subtract(29, 'days');
        let endDate = moment();

        function daterangeHandler(start, end) {
            startDate = start;
            endDate = end;

            $('.btn-daterange span').html(`${start.format('DD MMMM YYYY')} - ${end.format('DD MMMM YYYY')}`);
        }

        async function getChartLabelsAndDatasets(url) {
            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                body: JSON.stringify({
                    startDate: startDate.format('YYYY-MM-DD'),
                    endDate: endDate.format('YYYY-MM-DD'),
                }),
            });

            if (!response.ok) {
                const json = await response.json();

                throw new Error(`[HTTP ${response.status}] ${json.message}`);
            }

            return await response.json();
        }

        $(document).ready(function () {
            $('.btn-daterange').daterangepicker({
                ranges: {
                    '@lang('Today')': [moment(), moment()],
                    '@lang('Yesterday')': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    '@lang('Last 7 Days')': [moment().subtract(6, 'days'), moment()],
                    '@lang('Last 30 Days')': [moment().subtract(29, 'days'), moment()],
                    '@lang('This Month')': [moment().startOf('month'), moment().endOf('month')],
                    '@lang('Last Month')': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                    '@lang('This Year')': [moment().startOf('year'), moment().endOf('year')],
                },
                startDate,
                endDate,
                maxDate: moment(),
                locale: {
                    applyLabel: '@lang('Apply')',
                    cancelLabel: '@lang('Cancel')',
                    customRangeLabel: '@lang('Choose date')',
                },
            }, daterangeHandler);

            daterangeHandler(startDate, endDate);

            $('.btn-daterange').on('cancel.daterangepicker', function(ev, picker) {
                startDate = null;
                endDate = null;

                $('.btn-daterange span').html('@lang('Choose date')');
            });

            const chartElement = document.getElementById('chart').getContext('2d');

            let chart = new Chart(chartElement, {
                type: 'bar',
                options: {
                    legend: {
                        display: false,
                    },
                    scales: {
                        yAxes: [
                            {
                                gridLines: {
                                    drawBorder: false,
                                    color: '#f2f2f2',
                                },
                                ticks: {
                                    beginAtZero: true,
                                    stepSize: 150,
                                },
                            },
                        ],
                        xAxes: [
                            {
                                gridLines: {
                                    display: false,
                                },
                            },
                        ],
                    },
                    elements: {
                        pointRadius: 4,
                    },
                },
            });

            $('button#download-chart').click(function () {
                const a = document.createElement('a');

                a.href = chart.toBase64Image();
                a.download = `${moment().format('YYYY-MM-DD')}.png`;

                a.click();
            });

            $('button#load-chart-data').click(async function () {
                $(this).attr('disabled', 'disabled').addClass('btn-progress');

                try {
                    chart.data = await getChartLabelsAndDatasets('{{ route('achievement.laporan-pencapaian-new-cin-chart') }}');

                    chart.update();
                } catch (error) {
                    console.error(error);

                    alert(error.message);
                }

                $(this).removeAttr('disabled').removeClass('btn-progress');
            });
        });
    </script>
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Laporan Pencapaian New CiN</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                    <a href="{{ route('achievement.index') }}">
                        <i class="fas @lang('icon.achievement')"></i> <span>@lang('menu.achievement')</span>
                    </a>
                </div>

                <div class="breadcrumb-item">
                    <a href="{{ route('achievement.laporan-pencapaian-new-cin') }}">
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
                        <div class="col-12 col-xl-5 offset-xl-7">
                            <div class="btn-group btn-block">
                                <button class="btn btn-outline-primary btn-icon icon-left btn-daterange">
                                    <i class="fa fa-calendar"></i> <span>@lang('Choose date')</span>
                                </button>

                                <button type="button" id="load-chart-data" class="btn btn-primary btn-icon icon-left col-2 col-xl-3">
                                    <i class="fa fa-search"></i> <span class="d-none d-xl-inline">@lang('Search')</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <canvas id="chart" height="180" class="mt-3"></canvas>

                    <div class="statistic-details mt-1">
                        <div class="statistic-details-item">
                            <div class="text-small text-muted"><span class="text-primary"><i class="fas fa-caret-up"></i></span> 7%</div>
                            <div class="detail-value">$243</div>
                            <div class="detail-name">Today</div>
                        </div>

                        <div class="statistic-details-item">
                            <div class="text-small text-muted"><span class="text-danger"><i class="fas fa-caret-down"></i></span> 23%</div>
                            <div class="detail-value">$2,902</div>
                            <div class="detail-name">This Week</div>
                        </div>

                        <div class="statistic-details-item">
                            <div class="text-small text-muted"><span class="text-primary"><i class="fas fa-caret-up"></i></span>9%</div>
                            <div class="detail-value">$12,821</div>
                            <div class="detail-name">This Month</div>
                        </div>

                        <div class="statistic-details-item">
                            <div class="text-small text-muted"><span class="text-primary"><i class="fas fa-caret-up"></i></span> 19%</div>
                            <div class="detail-value">$92,142</div>
                            <div class="detail-name">This Year</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
