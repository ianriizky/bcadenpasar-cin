@extends('layouts.admin')

@section('style')
    <link rel="stylesheet" href="{{ mix('node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ mix('node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
@endsection

@section('script')
    <script src="{{ mix('node_modules/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ mix('node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ mix('node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/helpers/data-checkboxes.js') }}"></script>
    <script>
        const datatable_url = '{{ route('master.user.datatable') }}';
        const datatable_columns = [
            { data: 'checkbox', searchable: false, orderable: false, width: '5%' },
            { data: 'branch_name' },
            { data: 'username' },
            { data: 'name' },
            { data: 'email' },
            { data: 'action', searchable: false, orderable: false, width: '26%' },
        ];
        @include('components.datatables.language-url')
    </script>
    <script src="{{ asset('js/helpers/datatable.js') }}"></script>
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>@lang('List :name', ['name' => __('menu.user')])</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                    <a href="{{ route('master.index') }}">
                        <i class="fas @lang('icon.master')"></i> <span>@lang('menu.master')</span>
                    </a>
                </div>

                <div class="breadcrumb-item">
                    <a href="{{ route('master.user.index') }}">
                        <i class="fas @lang('icon.user')"></i> <span>@lang('menu.user')</span>
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
                                @can('create', \App\Models\User::class)
                                    <a href="{{ route('master.user.create') }}" class="btn btn-success">
                                        <i class="fas fa-plus-square"></i> <span>@lang('Add :name', ['name' => __('menu.user')])</span>
                                    </a>
                                @endcan
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped datatable">
                                        <thead>
                                            <tr>
                                                <th>@include('components.datatables.checkbox-all')</th>
                                                <th>@lang('menu.branch')</th>
                                                <th>Username</th>
                                                <th>@lang('Name')</th>
                                                <th>@lang('Email Address')</th>
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
                                    @include('components.datatables.checkbox-delete', ['url' => route('master.user.destroy-multiple')])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
@endsection
