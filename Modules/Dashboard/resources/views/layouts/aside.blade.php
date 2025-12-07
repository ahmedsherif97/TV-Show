<!-- you can edit your custom aside menu here -->

{{-- @foreach (app('modules')->list() as $module)--}}
{{--    @includeIf(strtolower($module) . '::dashboard.layouts.aside')--}}
{{--@endforeach --}}



@includeIf('tvshow::dashboard.layouts.aside')
@includeIf('episode::dashboard.layouts.aside')
@includeIf('user::dashboard.layouts.aside')
{{-- @includeIf('permission::dashboard.layouts.aside') --}}
{{-- @includeIf('role::dashboard.layouts.aside') --}}





<li class="menu-item">
    <a href="{{ route('admin.logout') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-log-out"></i>
        <div class="text-truncate">{{ __('dashboard.logout') }}</div>
    </a>
</li>
