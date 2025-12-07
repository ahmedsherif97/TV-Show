@props(['module', 'id' => null, 'delete' => true, 'edit' => true, 'view' => false, 'dots' => false])


<div class="d-none d-inline-block">
    <a href="javascript:;" class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
        <i class="bx bx-dots-vertical-rounded"></i></a>
    <div class="dropdown-menu dropdown-menu-end m-0">

        {!! $slot !!}

        <div class="dropdown-divider"></div>
        @if ($edit)
            @can('update ' . $module)
                <a href="{{ route('dashboard.' . $module . '.edit', $id) }}"
                   class="dropdown-item text-black">{{ __('faq::dashboard.edit') }}</a>
            @endcan
        @endif
        @if ($delete)
            @can('delete ' . $module)
                <button data-href="{{ route('dashboard.' . $module . '.destroy', $id) }}" type="button"
                        class="dropdown-item text-danger" data-bs-target="#confirmDeleteModal" data-bs-toggle="modal"
                        data-bs-dismiss="modal"><strong>{{ __('dashboard.delete') }}</strong></button>
            @endcan
        @endif
    </div>
</div>

<span class="">
    {!! $slot !!}

    @if ($edit)
        @can('update ' . $module)
            <a href="{{ route('dashboard.' . $module . '.edit', $id) }}" class="btn btn-sm btn-icon mt-1 text-end"><i
                        class="bx bx-edit"></i></a>
        @endcan
    @endif

    @if ($delete)
        @can('delete ' . $module)
            <button data-href="{{ route('dashboard.' . $module . '.destroy', $id) }}" type="button"
                    class="btn btn-sm btn-icon" data-bs-target="#confirmDeleteModal" data-bs-toggle="modal"
                    data-bs-dismiss="modal"><i class="bx bx-trash"></i></button>
        @endcan
    @endif

</span>
