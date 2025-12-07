@extends('dashboard.layouts.auth')

@section('content')
    <div class="position-relative w-100">
        <div class="row w-100 m-0" style="height: 100vh;">
            <div class="col-md-6 d-none d-md-block p-0 position-relative">
                <div class="h-100 w-100 position-absolute top-0 start-0 auth-side-image">
                </div>
            </div>
        </div>

        <!-- Overlay Form (Centered on all screens) -->
        <div class="card position-absolute top-50 translate-middle bg-white shadow-lg rounded-3 p-4"
            style="max-width: 700px; width: 90%; right: 70%; left: auto;" id="card">


            <div class="card-body py-0">
                <div class="text-center">
                    <!-- Logo -->
                    <div class="mb-3 d-flex justify-content-center align-items-center">
                        {{-- <img src="{{ app('settings')->find('logo') . '?v=662' }}" class="img-fluid" style="width: 70px"
                            alt=""> --}}
                        <h3 class="fw-bolder text-secondary mt-4 mx-2">{{ app('settings')->find('name') }}</h3>
                    </div>

                    <h4 class="fw-bold text-dark">تغيير كلمة المرور </h4>
                    {{-- <p class="text-muted">سجل دخول لحسابك على منصة <span class="fw-bolder text-primary">
                            {{ app('settings')->find('name') }}</span></p> --}}
                </div>

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <form id="formAuthentication" class="mb-3" action="{{ route('admin.password.email') }}" method="POST">
                    @csrf

                    <x-dashboard.forms.input type="text" name="email" label="{{ __('dashboard.email') }}"
                        placeholder="{{ __('dashboard.email') }}" autofocus />

                    {{--                    <div class="mb-3"> --}}
                    {{--                        {!! GoogleReCaptchaV3::renderField('login_captcha', 'main') !!} --}}
                    {{--                        {!! GoogleReCaptchaV3::init() !!} --}}
                    {{--                    </div> --}}

                    <button type="submit" class="btn btn-primary w-100">
                        {{ __('dashboard.send.password.reset') }}
                    </button>

                    <p class="text-center mt-3 fw-bold">
                        <a href="{{ route('admin.login') }}" class="text-primary px-1">الذهاب لتسجيل الدخول</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
@endsection
