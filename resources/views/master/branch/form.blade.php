@extends('layouts.admin')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ $title }}</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                    <a href="{{ route('master.index') }}">
                        <i class="fas @lang('icon.master')"></i> <span>@lang('menu.master')</span>
                    </a>
                </div>

                <div class="breadcrumb-item">
                    <a href="{{ route('master.branch.index') }}">
                        <i class="fas @lang('icon.branch')"></i> <span>@lang('menu.branch')</span>
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
                            {{-- name --}}
                            <div class="form-group col-12 col-lg-6">
                                <label for="name">@lang('Name')<span class="text-danger">*</span></label>

                                <input type="text"
                                    name="name"
                                    id="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $branch->name) }}"
                                    required>

                                <x-invalid-feedback :name="'name'"/>
                            </div>
                            {{-- /.name --}}

                            <div class="col-12 col-lg-6"></div>

                            {{-- address --}}
                            <div class="form-group col-12 col-lg-6">
                                <label for="address">@lang('Address')<span class="text-danger">*</span></label>

                                <textarea name="address"
                                    id="address"
                                    class="form-control @error('address') is-invalid @enderror"
                                    style="resize: vertical; height: auto;"
                                    required>{{ old('address', $branch->address) }}</textarea>

                                <x-invalid-feedback :name="'address'"/>
                            </div>
                            {{-- /.address --}}
                        </div>

                        @includeWhen($branch->exists, 'components.form-timestamps', ['model' => $branch])
                    </div>

                    <div class="card-footer">
                        @can('viewAny', \App\Models\Branch::class)
                            @include('components.datatables.link-back', ['url' => route('master.branch.index')])
                        @endcan

                        @if (isset($destroy_action) && Auth::user()->can('delete', $branch))
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
