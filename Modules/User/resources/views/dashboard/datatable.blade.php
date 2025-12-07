@foreach ($result as $index => $row)
    <tr>
        <td data-column="id">{{ $result->firstItem() + $index }}</td>
        <td data-column="name">
            {{-- <a href="{{ route('dashboard.user.show', $row->id) }}" class="text-body text-truncate"> --}}
            <span class="fw-medium">
                {{ $row->name ?? '' }}
            </span>
            <br>
            {{-- </a> --}}
            <small class="text-muted">
                {{ $row->username ?? '' }}
            </small>
        </td>

        <td data-column="email">
            <div class="text-center"> {{ $row->email ?? '' }}</div>
        </td>
        <td data-column="role">
            <div class="text-center"> {{ $row->type == 'student' ? 'طالب' : 'مسئول' }}</div>
        </td>
        <td data-column="actions">
            <div class="text-center">

                <x-dashboard.table.actions :edit="false" :delete="false" module='user' id='{{ $row->id }}'>

                    @if($row->type == 'admin')
                        @can('update user')
                            <a class="btn btn-sm btn-icon me-2"
                               href="{{ url('dashboard/user/' . $row->id . '/roles') }}">
                                <i class="fas fa-gear"></i>
                            </a>
                        @endcan
                    @endif

                </x-dashboard.table.actions>

            </div>
        </td>
    </tr>
@endforeach
