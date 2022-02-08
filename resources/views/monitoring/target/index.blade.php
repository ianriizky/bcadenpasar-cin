@extends('layouts.admin')

@section('style')
    <link rel="stylesheet" href="{{ mix('node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ mix('node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
@endsection

@section('script')
    <script src="{{ mix('node_modules/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ mix('node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ mix('node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>
    <script src="{{ mix('js/helpers/data-checkboxes.js') }}"></script>
    <script>
        const datatable_url = '{{ route('monitoring.target.datatable') }}';
        const datatable_columns = [
            { data: 'checkbox', searchable: false, orderable: false, width: '5%' },
            { data: 'periodicity' },
            { data: 'start_date' },
            { data: 'end_date' },
            { data: 'amount' },
            { data: 'action', searchable: false, orderable: false, width: '26%' },
        ];
        @include('components.datatables.language-url')
    </script>
    <script src="{{ mix('js/helpers/datatable.js') }}"></script>
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>@lang('List :name', ['name' => __('menu.target')])</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                    <a href="{{ route('monitoring.index') }}">
                        <i class="fas @lang('icon.monitoring')"></i> <span>@lang('menu.monitoring')</span>
                    </a>
                </div>

                <div class="breadcrumb-item">
                    <a href="{{ route('monitoring.target.index') }}">
                        <i class="fas @lang('icon.target')"></i> <span>@lang('menu.target')</span>
                    </a>
                </div>
            </div>
        </div>

        <form method="post">
            @csrf

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                @can('create', \App\Models\Target::class)
                                    <a href="{{ route('monitoring.target.create') }}" class="btn btn-success">
                                        <i class="fas fa-plus-square"></i> <span>@lang('Add :name', ['name' => __('menu.target')])</span>
                                    </a>
                                @endcan
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped datatable">
                                        <thead>
                                            <tr>
                                                <th>@include('components.datatables.checkbox-all')</th>
                                                <th>@lang('Periodicity')</th>
                                                <th>@lang('Start Date')</th>
                                                <th>@lang('End Date')</th>
                                                <th>@lang('Amount')</th>
                                                <th>@lang('Action')</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>

                            <div class="card-footer">
                                @lang('Selected') (<span id="checkbox-selected-display">0</span>)

                                <br>

                                <div class="btn-group">
                                    @include('components.datatables.checkbox-delete', ['url' => route('monitoring.target.destroy-multiple')])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
@endsection
