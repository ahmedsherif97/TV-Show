@canany(['list role', 'list permission'])
    <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-check-shield"></i>
            <div class="text-truncate">{{ __('role::dashboard.roles') }}</div>
        </a>
        <ul class="menu-sub">
            @can('list role')
                <li class="menu-item">
                    <a href="{{ route('dashboard.role.index') }}" class="menu-link">
                        <div class="text-truncate">{{ __('role::dashboard.list') }} {{ __('role::dashboard.roles') }}</div>
                    </a>
                </li>
            @endcan
{{--            @can('list permission')--}}
{{--                <li class="menu-item">--}}
{{--                    <a href="{{ route('dashboard.permission.index') }}" class="menu-link">--}}
{{--                        <div class="text-truncate">{{ __('permission::dashboard.list') }}--}}
{{--                            {{ __('permission::dashboard.permissions') }}</div>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--            @endcan--}}
        </ul>
    </li>
@endcanany
