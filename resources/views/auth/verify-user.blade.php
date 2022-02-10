@extends('layouts.master')

@section('title', __('Verify User'))

@section('content')
    <section class="section">
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                    <div class="login-brand">
                        <img src="{{ asset('img/logo.png') }}" alt="logo" width="100" class="shadow-light rounded-circle">
                    </div>

                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>@lang('Verify User')</h4>
                        </div>

                        <div class="card-body">
                            <p class="text-muted">
                                @lang('Thanks for signing up! Our administrator will verify your email address before you can start using the application. If your account is still unverified, please contact the administrator.')
                            </p>

                            <form method="post">
                                @csrf

                                <div class="form-group">
                                    <button type="submit" formaction="{{ route('logout') }}" class="btn btn-danger btn-lg btn-block">
                                        @lang('Logout')
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    @include('components.footer')
                </div>
            </div>
        </div>
    </section>
@endsection
