{{-- @props([
    'title' => '',
])

<h4 class="py-3 mb-2">
    <span class="text-muted fw-light">
        <i class="bx bx-home-circle d-none d-xl-inline-block "></i>
        <i class="layout-menu-toggle d-xl-none bx bx-menu bx-md" style="cursor:pointer;"></i>
        {{ __('dashboard.dashboard') }} @if ($title != '' || $slot != '')
            /
        @endif
    </span>

    {!! $slot !!}

    {{ $title ?? '' }}
</h4> --}}
@props([ 'title' => '', ])

<h4 class="py-3 mb-2">
    <span class="text-muted fw-light">
        <!-- رابط لـ Dashboard -->
        <a href="{{ route('dashboard.home') }}">
            <i class="bx bx-home-circle d-none d-xl-inline-block"></i>
            <i class="layout-menu-toggle d-xl-none bx bx-menu bx-md" style="cursor:pointer;"></i>
            {{ __('dashboard.dashboard') }}
        </a> 
        @if ($title != '' || $slot != '')
            /
        @endif
    </span>

    {!! $slot !!}

    {{ $title ?? '' }}
 
</h4>
