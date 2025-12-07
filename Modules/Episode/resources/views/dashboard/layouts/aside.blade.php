@canany(['create episode', 'list episode'])
<li class="menu-item">
    <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-user"></i>
        <div class="text-truncate">{{__('episode::dashboard.episodes')}}</div>
    </a>
    <ul class="menu-sub">
        @can('create episode')
            <li class="menu-item">
                <a href="{{route('dashboard.episode.create')}}" class="menu-link">
                    <div class="text-truncate">{{__('episode::dashboard.create')}} {{__('episode::dashboard.episode')}}</div>
                </a>
            </li>
        @endcan
        @can('list episode')
            <li class="menu-item">
                <a href="{{route('dashboard.episode.index')}}" class="menu-link">
                    <div class="text-truncate">{{__('episode::dashboard.list')}} {{__('episode::dashboard.episodes')}}</div>
                </a>
            </li>
        @endcan
    </ul>
</li>
@endcanany