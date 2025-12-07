<div class="col-md-10 d-flex align-items-center px-0">
    @stack('breadcrumbs')
</div>
<?php
$notifications = \Modules\Notification\App\Models\Notification::query()->latest()->limit(3)->get();
?>
{{-- @if (auth()->user()->userable)
    <?php
    $notifications = auth()->user()->userable?->notifications()->latest()->limit(3)->get();
    ?>
@else
    <?php
    $notifications = \Modules\Notification\App\Models\Notification::query()->latest()->limit(3)->get();
    ?>
@endif --}}
<div class="col-md-2 d-flex justify-content-end px-0">
    <ul class="navbar-nav flex-row align-items-center ms-auto flex-nowrap">
        <!-- Language -->
        {{-- <li class="nav-item dropdown-language dropdown mx-2">
            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                <i class="bx bx-globe bx-sm"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                @if (app()->getLocale() == 'en')
                    <li>
                        <a class="dropdown-item lang-switch-ar"
                            href="{{ LaravelLocalization::getLocalizedURL('ar', null, [], true) }}"
                            hreflang="{{ 'ar' }}">
                            <span class="align-middle">العربية</span>
                        </a>
                    </li>
                @else
                    <li>
                        <a class="dropdown-item lang-switch-en"
                            href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}"
                            hreflang="{{ 'en' }}">
                            <span class="align-middle">English</span>
                        </a>
                    </li>
                @endif
            </ul>
        </li> --}}

        <!-- Notification -->
        <li class="nav-item dropdown-notifications navbar-dropdown dropdown mx-2">
            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown"
                data-bs-auto-close="outside">
                <i class="bx bx-bell bx-sm"></i>
                {{-- @if (auth()->user()->userable)
                    <span
                        class="badge bg-danger rounded-pill badge-notifications d-inline-block text-nowrap">{{ auth()->user()->userable?->notifications()->count() }}</span>
                @else --}}
                <span
                    class="badge bg-danger rounded-pill badge-notifications d-inline-block text-nowrap">{{ \Modules\Notification\App\Models\Notification::query()->count() }}</span>
                {{-- @endif --}}
            </a>
            <ul class="dropdown-menu dropdown-menu-end py-0">
                <li class="dropdown-menu-header border-bottom">
                    <div class="dropdown-header d-flex align-items-center py-3">
                        <h5 class="text-body mb-0 me-auto">{{ __('notification::dashboard.notifications') }}</h5>
                        <a href="javascript:void(0)" class="dropdown-notifications-all text-body"
                            data-bs-toggle="tooltip" data-bs-placement="top" title="Mark all as read">
                            <i class="bx fs-4 bx-envelope-open"></i>
                        </a>
                    </div>
                </li>
                <li class="dropdown-notifications-list scrollable-container">
                    <ul class="list-group list-group-flush">
                        @foreach ($notifications as $notification)
                            <li class="list-group-item list-group-item-action dropdown-notifications-item">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="mb-0">
                                            {{ __(json_decode(json_encode($notification->data))->message ?? '') }}</p>
                                        <small
                                            class="text-muted">{{ $notification->created_at->format('Y/M/d H:i') }}</small>
                                    </div>
                                    <div class="flex-shrink-0 dropdown-notifications-actions">
                                        <a href="javascript:void(0)" class="dropdown-notifications-read"><span
                                                class="badge badge-dot"></span></a>
                                        <a href="javascript:void(0)" class="dropdown-notifications-archive"><span
                                                class="bx bx-x"></span></a>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li class="dropdown-menu-footer border-top p-3">
                    <a href="{{ route('dashboard.notification.index') }}"
                        class="btn btn-primary text-uppercase w-100">كل الإشعارات</a>
                </li>
            </ul>
        </li>

        <!-- User -->
        <li class="nav-item navbar-dropdown dropdown-user dropdown mx-2">
            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                <div class="avatar avatar-online">
                    <img src="{{ asset('assets/img/avatar.jpg') }}" alt class="w-px-40 h-auto rounded-circle" />
                </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <a class="dropdown-item" href="{{ route('admin.logout') }}">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">{{ __('dashboard.logout') }}</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</div>
