@extends('dashboard.layouts.auth')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success col-xl-12 col-lg-12 col-md-12 col-sm-12 layout-top-spacing">
            <p style="" class="text-dark">
                {{ session('success') }}
            </p>
                <?php
                session()->put('success', null);
                ?>
        </div>
    @endif
    @if (session()->has('resend'))
        <div class="alert alert-success col-xl-12 col-lg-12 col-md-12 col-sm-12 layout-top-spacing">
            <p style="" class="text-dark">
                {{ __('dashboard.email resent successfully') }}
            </p>
                <?php
                session()->put('resend', null);
                ?>
        </div>
    @endif
    <p class="mb-4">{{ __('dashboard.Please sign-in to your account and start the adventure') }}</p>

    <form id="formAuthentication" class="mb-3" action="{{ route('admin.login') }}" method="POST">
        @csrf

        <x-dashboard.forms.input type="text" name="email-username" label="{{ __('dashboard.Email or Username') }}"
                                 placeholder="{{ __('dashboard.Enter your email or username') }}" autofocus />

        <x-dashboard.forms.input type="password" name="password" label="{{ __('dashboard.password') }}"
                                 placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />

        <div class="mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="remember-me" name="remember" value="1" />
                <label class="form-check-label" for="remember-me">{{ __('dashboard.remember.me') }}</label>
            </div>
        </div>

        <input type="hidden" name="previous"
               value="{{ Request::has('previous') ? Request::get('previous') : URL::previous() }}">

        <div class="mb-3">
            <button class="btn btn-primary d-grid w-100"
                    type="submit">{{ __('dashboard.Please sign-in') }}</button>
        </div>
    </form>

    <p class="text-center">
        <span>{{ __('dashboard.Forgot Password?') }}</span>

        <a href="{{ route('admin.password.request') }}">
            <small>{{ __('dashboard.reset.password') }}</small>
        </a>
    </p>
@endsection
