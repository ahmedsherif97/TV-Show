<!DOCTYPE html>
<html dir="rtl" lang="ar">
@include('frontend.includes.head')

<body>
    @include('frontend.includes.header')
    @yield('content')
    @include('frontend.includes.footer')
    @include('frontend.includes.scripts')
</body>

</html>
