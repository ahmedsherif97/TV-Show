@can('show notification')

    <li class="menu-item">
        <a href="{{ route('dashboard.notification.index') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-bell"></i>
            <div class="text-truncate">{{ __('notification::dashboard.notifications') }}</div>
        </a>
    </li>
@endcan
