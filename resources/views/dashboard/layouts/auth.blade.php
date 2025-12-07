<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact"
      dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}" data-theme="theme-default"
      data-assets-path="{{ asset('assets') }}/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    @stack('meta')

    <title>Dashboard - Analytics | TV Show</title>

    <meta name="description" content="" />


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets') }}/img/favicon/favicon.ico" />

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
    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/css/pages/page-auth.css" />

    @stack('styles')

</head>

<body>
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <!-- Register -->
            <div class="card">
                <div class="card-body">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center">

                    </div>

                    @yield('content')

                    {{--                        <div class="divider my-4"> --}}
                    {{--                            <div class="divider-text">or</div> --}}
                    {{--                        </div> --}}

                    {{--                        <div class="d-flex justify-content-center"> --}}
                    {{--                            <a href="javascript:;" class="btn btn-icon btn-label-facebook me-3"> --}}
                    {{--                                <i class="tf-icons bx bxl-facebook"></i> --}}
                    {{--                            </a> --}}

                    {{--                            <a href="javascript:;" class="btn btn-icon btn-label-google-plus me-3"> --}}
                    {{--                                <i class="tf-icons bx bxl-google-plus"></i> --}}
                    {{--                            </a> --}}

                    {{--                            <a href="javascript:;" class="btn btn-icon btn-label-twitter"> --}}
                    {{--                                <i class="tf-icons bx bxl-twitter"></i> --}}
                    {{--                            </a> --}}
                    {{--                        </div> --}}
                </div>
            </div>
            <!-- /Register -->
        </div>
    </div>
</div>

<script src="{{ asset('assets') }}/vendor/libs/jquery/jquery.js"></script>
<script src="{{ asset('assets') }}/vendor/libs/popper/popper.js"></script>

<script src="{{ asset('assets') }}/vendor/libs/@form-validation/umd/bundle/popular.min.js"></script>
<script src="{{ asset('assets') }}/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js"></script>
<script src="{{ asset('assets') }}/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js"></script>


<!-- Page JS -->
<script src="{{ asset('assets') }}/js/pages-auth.js?version={{ filemtime(public_path('/assets/js/pages-auth.js')) }}">
</script>

<script>
    $(document).ready(function() {
        $('input[name="password"]').each(function() {
            const $input = $(this);
            const $togglePassword = $input.next('span');

            $togglePassword.on('click', function() {
                const type = $input.attr('type') === 'password' ? 'text' : 'password';
                $input.attr('type', type);

                // Toggle the icon
                $(this).find('i').toggleClass('bx-hide bx-show');
            });
        });
    });
</script>

@includeIf('dashboard.layouts.validation-script')

@stack('scripts')
</body>

</html>
