<!DOCTYPE html>
<html lang="ar" dir="rtl" class="scroll-smooth">

<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="الرئيسية - اللوحة التعليمية - برنامج التأهيل اللغوي"/>
    <meta name="keywords" content="keyword 1, keyword 2, keyword 3"/>
    <meta name="language" content="Arabic">
    <title>
        الرئيسية - اللوحة التعليمية - برنامج التأهيل اللغوي
    </title>

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="https://"/>
    <meta property="og:title" content="
          الرئيسية - اللوحة التعليمية - برنامج التأهيل اللغوي
        "/>
    <meta property="og:description" content="برنامج التأهيل اللغوي"/>
    <meta property="og:image" content="https://metatags.io/images/meta-tags.png"/>

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image"/>
    <meta property="twitter:url" content=""/>
    <meta property="twitter:title" content="
        الرئيسية - اللوحة التعليمية - برنامج التأهيل اللغوي
        "/>
    <meta property="twitter:description" content="برنامج التأهيل اللغوي"/>
    <meta property="twitter:image" content="https://metatags.io/images/meta-tags.png"/>

    <link rel="icon" href="{{asset('front/assets/images/favicon/favicon.ico')}}" sizes="32x32">
    <link rel="apple-touch-icon" href="{{asset('front/assets/images/favicon/apple-touch-icon.png')}}"><!-- 180×180 -->
    <link rel="manifest" href="{{asset('front/assets/images/site.webmanifest')}}">

    <link rel="stylesheet" href="{{asset('front/src/output.css').'?v=1'}}"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
          integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/toastr/toastr.css') }}"/>

</head>

<body>
<div class="flex">
    <!-- Sidebar -->

    @includeIf('user.dashboard.side')
    <div class="flex flex-col flex-auto min-h-screen min-w-0 relative w-full bg-white">
        <!-- Navbar -->

        @includeIf('user.dashboard.header')
        <!-- Main Content -->
        <main class="h-full flex flex-col gap-5 p-6 bg-[#fafafa]">
            @yield('breadcrumb')

            @if(session('alert-success'))
                <div class="alert alert-success alert-hidden" role="alert">
                    <i class="fas fa-info-circle fa-lg me-3"></i>
                    <div>
                        {{session('alert-success')}}
                    </div>
                </div>
            @elseif(session('alert-error'))
                <div class="alert alert-danger alert-hidden" role="alert">
                    <i class="fas fa-info-circle fa-lg me-3"></i>
                    <div>
                        {{session('alert-error')}}
                    </div>
                </div>
            @endif

            <!-- Statistics Section -->
            @yield('content')
        </main>
    </div>

    <div class="overlay" onclick="toggleSidebar()"></div>
</div>

<!-- ====== All Scripts -->
<script type="text/javascript" src="{{asset('front/assets/js/main.js')}}"></script>
<script type="text/javascript" src="{{asset('front/assets/js/dropdown.js')}}"></script>
@stack('scripts')
<script src="{{ asset('assets/vendor/libs/toastr/toastr.js') }}"></script>
<script>
    $(document).ready(function () {
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
    });
</script>

</body>

</html>