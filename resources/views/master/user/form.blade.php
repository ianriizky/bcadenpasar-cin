@extends('layouts.admin')

@section('pre-style')
    <link rel="stylesheet" href="{{ mix('node_modules/select2/dist/css/select2.min.css') }}">
@endsection

@section('script')
    <script src="{{ mix('node_modules/select2/dist/js/select2.full.min.js') }}"></script>
    <script>
        $(function() {
            $('.select2').select2();

            @include('components.select2-change', ['olds' => Arr::except(old() ?: $user, '_token')])
        });
    </script>
@endsection

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
                    <a href="{{ route('master.user.index') }}">
                        <i class="fas @lang('icon.user')"></i> <span>@lang('menu.user')</span>
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

                                <x-invalid-feedback :name="'branch_id'"/>
                            </div>
                            {{-- /.branch_id --}}

                            <div class="col-12 col-lg-6"></div>

                            {{-- username --}}
                            <div class="form-group col-12 col-lg-6">
                                <label for="username">Username<span class="text-danger">*</span></label>

                                <input type="text"
                                    name="username"
                                    id="username"
                                    class="form-control @error('username') is-invalid @enderror"
                                    value="{{ old('username', $user->username) }}"
                                    required>

                                <x-invalid-feedback :name="'username'"/>
                            </div>
                            {{-- /.username --}}

                            {{-- name --}}
                            <div class="form-group col-12 col-lg-6">
                                <label for="name">@lang('Name')<span class="text-danger">*</span></label>

                                <input type="text"
                                    name="name"
                                    id="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $user->name) }}"
                                    required>

                                <x-invalid-feedback :name="'name'"/>
                            </div>
                            {{-- /.name --}}

                            {{-- email --}}
                            <div class="form-group col-12 col-lg-6">
                                <label for="email">@lang('Email')<span class="text-danger">*</span></label>

                                <input type="email"
                                    name="email"
                                    id="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email', $user->email) }}"
                                    required>

                                <x-invalid-feedback :name="'email'"/>
                            </div>
                            {{-- /.email --}}

                            <div class="col-12 col-lg-6"></div>

                            {{-- password --}}
                            <div class="form-group col-12 col-lg-6">
                                @unless ($user->exists)
                                    <label for="password">@lang('Password')<span class="text-danger">*</span></label>
                                @else
                                    <label for="password">@lang('Reset Password')</label>
                                @endunless

                                <input type="password"
                                    name="password"
                                    id="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    @unless ($user->exists) required @endunless>

                                <x-invalid-feedback :name="'password'"/>
                            </div>
                            {{-- /.password --}}

                            {{-- password_confirmation --}}
                            <div class="form-group col-12 col-lg-6">
                                <label for="password_confirmation">@lang('Confirm Password')@unless ($user->exists) <span class="text-danger">*</span> @endunless</label>

                                <input type="password"
                                    name="password_confirmation"
                                    id="password_confirmation"
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    @unless ($user->exists) required @endunless>

                                <x-invalid-feedback :name="'password_confirmation'"/>
                            </div>
                            {{-- /.password_confirmation --}}

                            {{-- role --}}
                            <div class="form-group col-12 col-lg-6">
                                <label for="role">@lang('Role')<span class="text-danger">*</span></label>

                                <select name="role"
                                    id="role"
                                    class="form-control select2 @error('role') is-invalid @enderror"
                                    data-placeholder="--@lang('Choose :field', ['field' => __('Role') ])--"
                                    data-allow-clear="true"
                                    required>
                                    @foreach (\App\Models\Role::getRoles() as $role)
                                        <option value="{{ $role }}">{{ $role }}</option>
                                    @endforeach
                                </select>

                                <x-invalid-feedback :name="'role'"/>
                            </div>
                            {{-- /.role --}}
                        </div>

                        @if ($user->exists)
                            <div class="row">
                                {{-- email_verified_at --}}
                                <div class="form-group col-12 col-lg-6">
                                    <label for="email_verified_at">@lang('Verify Email Address')</label>

                                    <p class="form-control-plaintext">
                                        {{ $user->email_verified_at->translatedFormat('d F Y H:i:s') }}
                                    </p>
                                </div>
                                {{-- /.email_verified_at --}}
                            </div>
                        @endif

                        @includeWhen($user->exists, 'components.form-timestamps', ['model' => $user])
                    </div>

                    <div class="card-footer">
                        @can('viewAny', \App\Models\User::class)
                            @include('components.datatables.link-back', ['url' => route('master.user.index')])
                        @endcan

                        @if (isset($destroy_action) && Auth::user()->can('delete', $user))
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
