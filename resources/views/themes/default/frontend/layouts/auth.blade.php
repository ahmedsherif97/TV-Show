<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact"
    dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}" data-theme="theme-default"
    data-assets-path="{{ asset('assets') }}/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    @stack('meta')

    <title>{{ app('settings')->find('name') }}</title>

    <meta name="description" content="" />


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset(app('settings')->find('favicon')) }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/fonts/boxicons.css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/fonts/flag-icons.css" />

    <!-- Core CSS -->
    @if (app()->getLocale() == 'ar')
        <link rel="stylesheet" href="{{ asset('assets') }}/vendor/css/rtl/core.css"
            class="template-customizer-core-css" />
        <link rel="stylesheet" href="{{ asset('assets') }}/vendor/css/rtl/theme-default.css"
            class="template-customizer-theme-css" />
    @else
        <link rel="stylesheet" href="{{ asset('assets') }}/vendor/css/core.css" class="template-customizer-core-css" />
        <link rel="stylesheet" href="{{ asset('assets') }}/vendor/css/theme-default.css"
            class="template-customizer-theme-css" />
    @endif
    <link rel="stylesheet" href="{{ asset('assets') }}/css/demo.css?v=1" />
    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/css/pages/page-auth.css" />
    <style>
        :root {
            --bs-primary: {{ app('settings')->find('primary-color', '#696cff') }};
            --bs-link-color: {{ app('settings')->find('secondary-color', '#696cff') }};
            --bs-primary-focus-color: {{ app('settings')->find('secondary-color', '#5f61e6') }};
            --bg-gradient: linear-gradient(to bottom, {{ app('settings')->find('primary-color', '#696cff') }}99, {{ app('settings')->find('primary-color', '#696cff') }}00);
        }

        .auth-side-image {
            background:
                var(--bg-gradient),
                url('{{ asset(app('settings')->find('logo')) }}') center/contain no-repeat;
        }


        @media (max-width: 768px) {
            #card {
                top: 40% !important;
                right: 50% !important;
                left: auto;
                /*transform: translate(-50%, 0) !important;*/
            }
        }
    </style>
    @stack('styles')
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@100;200;300;400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Tajawal', sans-serif !important;
        }
    </style>
</head>

<body>

    <div class="authentication-wrapper authentication-cover">
        <div class="authentication-inner row m-0">
            <!-- Left Text -->
            <div class="d-none d-lg-flex col-lg-4 align-items-center justify-content-end p-5 pe-0 position-relative">
                <div class="h-100 w-100 position-absolute top-0 start-0 auth-side-image">
                </div>
            </div>
            <!-- /Left Text -->

            @yield('content')

        </div>
    </div>

    <script src="{{ asset('assets') }}/vendor/libs/jquery/jquery.js"></script>
    <script src="{{ asset('assets') }}/vendor/libs/popper/popper.js"></script>

    <script src="{{ asset('assets') }}/vendor/libs/@form-validation/umd/bundle/popular.min.js"></script>
    <script src="{{ asset('assets') }}/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js"></script>
    <script src="{{ asset('assets') }}/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js"></script>


    <!-- Page JS -->
    <script src="{{ asset('assets') }}/js/pages-auth.js"></script>

    <script type="text/javascript">
        var csrf_token = document.head.querySelector('meta[name="csrf-token"]').getAttribute("content");

        const toggleButtons = document.querySelectorAll('.form-password-toggle .input-group-text');

        toggleButtons.forEach(toggleButton => {
            const passwordField = toggleButton.parentElement.querySelector('.form-control');

            toggleButton.addEventListener('click', function() {
                if (passwordField.type === 'password') {
                    passwordField.type = 'text';
                    toggleButton.innerHTML = '<i class="bx bx-show"></i>';
                } else {
                    passwordField.type = 'password';
                    toggleButton.innerHTML = '<i class="bx bx-hide"></i>';
                }
            });
        });
    </script>

    @includeIf('dashboard.layouts.validation-script')

    @stack('scripts')
</body>

</html>
