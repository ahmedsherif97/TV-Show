@canany(['create user', 'list user', 'manage roles'])
    <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-cog"></i>
            <div class="text-truncate">{{ __('user::dashboard.users-permission') }}</div>
        </a>
        <ul class="menu-sub">
            <!-- Users Management -->
            <li class="menu-item">
                <a href="{{ route('dashboard.user.index') }}" class="menu-link">
                    <div class="text-truncate">{{ __('user::dashboard.users-managemnet') }}</div>
                </a>
            </li>

            <!-- Roles -->
            <li class="menu-item">
                <a href="{{ route('dashboard.role.index') }}" class="menu-link">
                    <div class="text-truncate">{{ __('role::dashboard.roles') }}</div>
                </a>
            </li>
        </ul>
    </li>
@endcanany
