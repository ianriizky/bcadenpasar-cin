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
        @if ($oldDate = old('date', $achievement->date_iso_format))
            const startDate = moment(@json($oldDate), @json(\App\Models\Achievement::DATE_FORMAT_ISO)).startOf('days');
        @else
            const startDate = moment().startOf('days');
        @endif

        const dateFormatIso = @json(\App\Models\Achievement::DATE_FORMAT_ISO);
        const nullExpression = @json(\App\Http\Middleware\ConvertNullStringsToNull::NULL_EXPRESSION);
        const select2Routes = {
            target: @json(route('monitoring.achievement.select2.target')),
            event: @json(route('monitoring.achievement.select2.event')),
            user: @json(route('monitoring.achievement.select2.user')),
        };
        const selectedBranch = @json(old('branch_id', optional($achievement->target)->branch_id));
        const selectedTarget = @json(old('target_id', $achievement->target_id));
        const selectedEvent = @json(old('event_id', $achievement->event_id));
        const selectedAchievedBy = @json(old('achieved_by', $achievement->achieved_by));

        $(function () {
            $('.select2').select2();

            @include('components.select2-change', ['olds' => Arr::except(old() ?: $achievement, '_token')])
        });
    </script>
    <script src="{{ mix('js/page/achievement/form.js') }}"></script>
    <script>
        $(async function () {
            @role (\App\Models\Role::ROLE_ADMIN)
                $('#branch_id').val(selectedBranch).trigger('change');
            @else
                await updateSelect2Option(
                    select2Routes.event, selectedBranch,
                    "#event_id", selectedEvent
                );
            @endrole

            @role (\App\Models\Role::ROLE_MANAGER)
                await updateSelect2Option(
                    select2Routes.user, selectedBranch,
                    "#achieved_by", selectedAchievedBy
                );
            @endrole
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
                    <a href="{{ route('monitoring.achievement.index') }}">
                        <i class="fas @lang('icon.achievement')"></i> <span>@lang('menu.achievement')</span>
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

                            {{-- target_id --}}
                            <div class="form-group col-12 col-lg-6">
                                <label for="target_id">@lang('menu.target')<span class="text-danger">*</span></label>

                                @role(\App\Models\Role::ROLE_ADMIN)
                                    <select name="target_id"
                                        id="target_id"
                                        class="form-control select2 @error('target_id') is-invalid @enderror"
                                        data-placeholder="--@lang('Choose :field', ['field' => __('menu.target') ])--"
                                        data-allow-clear="true"
                                        required disabled>
                                    </select>
                                @else
                                    <p class="form-control-plaintext">
                                        {{ Auth::user()->branch->currentTarget->name }}
                                    </p>
                                @endrole

                                <x-invalid-feedback :name="'target_id'"/>
                            </div>
                            {{-- /.target_id --}}

                            {{-- event_id --}}
                            <div class="form-group col-12 col-lg-6">
                                <label for="event_id">@lang('menu.event')</label>

                                <select name="event_id"
                                    id="event_id"
                                    class="form-control select2 @error('event_id') is-invalid @enderror"
                                    data-placeholder="--@lang('Choose :field', ['field' => __('menu.event') ])--"
                                    data-allow-clear="true"
                                    disabled>
                                </select>

                                <x-invalid-feedback :name="'event_id'"/>
                            </div>
                            {{-- /.event_id --}}

                            {{-- achieved_date --}}
                            <div class="form-group col-12 col-lg-6">
                                <label for="achieved_date">@lang('Achieved Date')<span class="text-danger">*</span></label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-calendar"></i>
                                        </div>
                                    </div>

                                    <input type="text"
                                        name="achieved_date"
                                        id="achieved_date"
                                        class="form-control @error('achieved_date') is-invalid @enderror"
                                        required readonly>

                                    <x-invalid-feedback :name="'achieved_date'"/>
                                </div>
                            </div>
                            {{-- achieved_date --}}

                            {{-- achieved_by --}}
                            <div class="form-group col-12 col-lg-6">
                                <label for="achieved_by">@lang('Achieved By')</label>

                                @unlessrole(\App\Models\Role::ROLE_STAFF)
                                    <select name="achieved_by"
                                        id="achieved_by"
                                        class="form-control select2 @error('achieved_by') is-invalid @enderror"
                                        data-placeholder="--@lang('Choose :field', ['field' => __('Achieved By') ])--"
                                        data-allow-clear="true"
                                        disabled>
                                    </select>
                                @else
                                    <p class="form-control-plaintext">
                                        {{ Auth::user()->name }}
                                    </p>
                                @endunlessrole

                                <x-invalid-feedback :name="'achieved_by'"/>
                            </div>
                            {{-- /.achieved_by --}}

                            {{-- amount --}}
                            <div class="form-group col-12 col-lg-6">
                                <label for="amount">@lang('Amount')<span class="text-danger">*</span></label>

                                <input type="number"
                                    name="amount"
                                    id="amount"
                                    class="form-control @error('amount') is-invalid @enderror"
                                    value="{{ old('amount', $achievement->getRawAttribute('amount')) }}"
                                    min="0"
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
                                    style="resize: vertical; height: auto;">{{ old('note', $achievement->note) }}</textarea>

                                <x-invalid-feedback :name="'note'"/>
                            </div>
                            {{-- /.note --}}
                        </div>

                        @includeWhen($achievement->exists, 'components.form-timestamps', ['model' => $achievement])
                    </div>

                    <div class="card-footer">
                        @can('viewAny', \App\Models\Achievement::class)
                            @include('components.datatables.link-back', ['url' => route('monitoring.achievement.index')])
                        @endcan

                        @if (isset($destroy_action) && Auth::user()->can('delete', $achievement))
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
