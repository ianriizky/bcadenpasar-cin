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

            @include('components.select2-change', ['olds' => Arr::except(old() ?: $event, '_token')])

            @if ($oldDate = old('date', $event->date_iso_format))
                const startDate = moment(@json($oldDate), @json(\App\Models\Event::DATE_FORMAT_ISO)).startOf('days');
            @else
                const startDate = moment().startOf('days');
            @endif

            $('#date').daterangepicker({
                locale: {
                    format: @json(\App\Models\Event::DATE_FORMAT_ISO),
                },
                startDate,
                singleDatePicker: true,
                autoApply: true,
                showWeekNumbers: true,
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
                    <a href="{{ route('monitoring.event.index') }}">
                        <i class="fas @lang('icon.event')"></i> <span>@lang('menu.event')</span>
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
                                        required>
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

                            {{-- name --}}
                            <div class="form-group col-12 col-lg-6">
                                <label for="name">@lang('Name')<span class="text-danger">*</span></label>

                                <input type="text"
                                    name="name"
                                    id="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $event->name) }}"
                                    min="0"
                                    required>

                                <x-invalid-feedback :name="'name'"/>
                            </div>
                            {{-- /.name --}}

                            {{-- date --}}
                            <div class="form-group col-12 col-lg-6">
                                <label for="name">@lang('Date')<span class="text-danger">*</span></label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-calendar"></i>
                                        </div>
                                    </div>

                                    <input type="text"
                                        name="date"
                                        id="date"
                                        class="form-control @error('date') is-invalid @enderror"
                                        required readonly>

                                    <x-invalid-feedback :name="'date'"/>
                                </div>
                            </div>
                            {{-- date --}}

                            {{-- location --}}
                            <div class="form-group col-12 col-lg-6">
                                <label for="location">@lang('Location')<span class="text-danger">*</span></label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                    </div>

                                    <input type="text"
                                        name="location"
                                        id="location"
                                        class="form-control @error('location') is-invalid @enderror"
                                        value="{{ old('location', $event->location) }}"
                                        required>

                                    <x-invalid-feedback :name="'location'"/>
                                </div>
                            </div>
                            {{-- /.location --}}

                            {{-- note --}}
                            <div class="form-group col-12 col-lg-6">
                                <label for="note">@lang('Note')</label>

                                <textarea name="note"
                                    id="note"
                                    class="form-control @error('note') is-invalid @enderror"
                                    style="resize: vertical; height: auto;">{{ old('note', $event->note) }}</textarea>

                                <x-invalid-feedback :name="'note'"/>
                            </div>
                            {{-- /.note --}}
                        </div>

                        @includeWhen($event->exists, 'components.form-timestamps', ['model' => $event])
                    </div>

                    <div class="card-footer">
                        @can('viewAny', \App\Models\Event::class)
                            @include('components.datatables.link-back', ['url' => route('monitoring.event.index')])
                        @endcan

                        @if (isset($destroy_action) && Auth::user()->can('delete', $event))
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
