@extends('layouts.admin')

@section('pre-style')
    <link rel="stylesheet" href="{{ mix('node_modules/select2/dist/css/select2.min.css') }}">
@endsection

@section('style')
    <link rel="stylesheet" href="{{ mix('node_modules/bootstrap-daterangepicker/daterangepicker.css') }}">
@endsection

@section('script')
    <script src="{{ mix('node_modules/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ mix('node_modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script>
        $(function() {
            $('.select2').select2();

            @include('components.select2-change', ['olds' => Arr::except(old() ?: $target, '_token')])

            $('.daterange').daterangepicker({
                drops: 'down',
                opens: 'right',
                startDate: moment().startOf('month'),
                endDate: moment().endOf('month'),
                autoApply: true,
                showWeekNumbers: true,
                locale: {
                    separator: @json(\App\Http\Requests\Target\StoreRequest::START_DATE_END_DATE_SEPARATOR),
                    format: @json(\App\Models\Target::DATE_FORMAT_ISO),
                },
            });
        });
    </script>
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ $title }}</h1>

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

                <div class="breadcrumb-item">
                    <a href="{{ $url }}">
                        <i class="fas {{ $icon }}"></i> <span>{{ $title }}</span>
                    </a>
                </div>
            </div>
        </div>

        <form method="post">
            @csrf

            <div class="section-body">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            {{-- branch_id --}}
                            <div class="form-group col-12 col-lg-6">
                                <label for="branch_id">@lang('menu.branch')<span class="text-danger">*</span></label>

                                @role(\App\Models\Role::ROLE_ADMIN)
                                    <select name="branch_id"
                                        id="branch_id"
                                        class="form-control select2 @error('branch_id') is-invalid @enderror"
                                        data-placeholder="--@lang('Choose :field', ['field' => __('menu.branch') ])--"
                                        data-allow-clear="true"
                                        required
                                        autofocus>
                                        @foreach (\App\Models\Branch::pluck('name', 'id') as $value => $label)
                                            <option value="{{ $value }}">{{ $label }}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <p class="form-control-plaintext">
                                        {{ Auth::user()->branch->name }}
                                    </p>
                                @endrole

                                <x-invalid-feedback :name="'branch_id'"/>
                            </div>
                            {{-- /.branch_id --}}

                            <div class="col-12 col-lg-6"></div>

                            {{-- periodicity --}}
                            <div class="form-group col-12 col-lg-6">
                                <label for="periodicity">@lang('Periodicity')<span class="text-danger">*</span></label>

                                <select name="periodicity"
                                    id="periodicity"
                                    class="form-control select2 @error('periodicity') is-invalid @enderror"
                                    data-placeholder="--@lang('Choose :field', ['field' => __('Periodicity') ])--"
                                    data-allow-clear="true"
                                    required
                                    autofocus>
                                    @foreach (\App\Enum\Periodicity::toArray() as $value => $label)
                                        <option value="{{ $value }}">{{ $label }}</option>
                                    @endforeach
                                </select>

                                <x-invalid-feedback :name="'periodicity'"/>
                            </div>
                            {{-- /.periodicity --}}

                            {{-- start_date && end_date --}}
                            <div class="form-group col-12 col-lg-6">
                                <label for="name">@lang('Start Date') & @lang('End Date')<span class="text-danger">*</span></label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-calendar"></i>
                                        </div>
                                    </div>

                                    <input type="text"
                                        name="start_date_end_date"
                                        id="start_date_end_date"
                                        class="form-control daterange @error('start_date_end_date') is-invalid @enderror"
                                        value="{{ old('start_date_end_date', $target->start_date_end_date) }}"
                                        required>

                                    <x-invalid-feedback :name="'start_date_end_date'"/>
                                </div>
                            </div>
                            {{-- /.start_date && end_date --}}

                            {{-- amount --}}
                            <div class="form-group col-12 col-lg-6">
                                <label for="amount">@lang('Amount')<span class="text-danger">*</span></label>

                                <input type="number"
                                    name="amount"
                                    id="amount"
                                    class="form-control @error('amount') is-invalid @enderror"
                                    value="{{ old('amount', $target->getRawAttribute('amount')) }}"
                                    min="0" step="1"
                                    required>

                                <x-invalid-feedback :name="'amount'"/>
                            </div>
                            {{-- /.amount --}}

                            {{-- note --}}
                            <div class="form-group col-12 col-lg-6">
                                <label for="note">@lang('Note')</label>

                                <textarea name="note"
                                    id="note"
                                    class="form-control @error('note') is-invalid @enderror"
                                    style="resize: vertical; height: auto;">{{ old('note', $target->note) }}</textarea>

                                <x-invalid-feedback :name="'note'"/>
                            </div>
                            {{-- /.note --}}
                        </div>

                        @includeWhen($target->exists, 'components.form-timestamps', ['model' => $target])
                    </div>

                    <div class="card-footer">
                        @can('viewAny', \App\Models\Target::class)
                            @include('components.datatables.link-back', ['url' => route('monitoring.target.index')])
                        @endcan

                        @if (isset($destroy_action) && Auth::user()->can('delete', $target))
                            <button type="submit"
                                formaction="{{ $destroy_action }}"
                                @isset($method) name="_method" value="DELETE" @endisset
                                onclick="return (confirm('@lang('Are you sure you want to delete this data?')'))"
                                class="btn btn-danger btn-icon icon-left">
                                <i class="fa fa-trash"></i> <span>@lang('Delete')</span>
                            </button>
                        @endif

                        <button type="submit"
                            formaction="{{ $submit_action }}"
                            @isset($method) name="_method" value="{{ $method }}" @endisset
                            class="btn btn-primary btn-icon icon-left">
                            <i class="fa fa-save"></i> <span>@lang('Save')</span>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </section>
@endsection
