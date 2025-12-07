<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme" style="background-color: #1E1E1E !important;">
    <div class="app-brand demo justify-content-start">
        <a href="{{ route('dashboard.home') }}" class="app-brand-link mx-2">
            <span class="app-brand-logo demo w-100">
            </span>
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    {{--    <div class="menu-inner-shadow"></div> --}}
    <ul class="menu-inner py-1">

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">{{ __('dashboard.Welcome to') }}
                <strong>{{ auth()->user()->name ?? '' }}</strong></span>
        </li>

        <li class="menu-item">
            <a href="{{ route('dashboard.home') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div class="text-truncate">{{ __('dashboard.dashboard') }}</div>
            </a>
        </li>

        @includeIf('dashboard::layouts.aside')

    </ul>
</aside>
