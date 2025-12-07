@canany(['create t_v_show', 'list t_v_show'])
<li class="menu-item">
    <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-user"></i>
        <div class="text-truncate">{{__('tvshow::dashboard.t_v_shows')}}</div>
    </a>
    <ul class="menu-sub">
        @can('create t_v_show')
            <li class="menu-item">
                <a href="{{route('dashboard.show.create')}}" class="menu-link">
                    <div class="text-truncate">{{__('tvshow::dashboard.create')}} {{__('tvshow::dashboard.a tvshow')}}</div>
                </a>
            </li>
        @endcan
        @can('list t_v_show')
            <li class="menu-item">
                <a href="{{route('dashboard.show.index')}}" class="menu-link">
                    <div class="text-truncate">{{__('tvshow::dashboard.list')}} {{__('tvshow::dashboard.t_v_shows')}}</div>
                </a>
            </li>
        @endcan
    </ul>
</li>
@endcanany