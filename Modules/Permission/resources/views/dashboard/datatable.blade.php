@foreach ($result as $index => $row)
    <tr>
        <td data-column="id">{{ $row->id }}</td>
        <td data-column="name">{{ $row->name }}</td>
        <td data-column="roles">
            <span class="text-nowrap">
                @foreach ($row->roles ?? [] as $role)
                    <a href="{{ route('dashboard.role.edit', $role->id) }}">
                        <span class="badge bg-label-primary m-1">
                            {{ $role->name ?? '' }}
                        </span>
                    </a>
                @endforeach
            </span>
        </td>
        <td data-column="actions">
            <x-dashboard.table.actions module='permission' id='{{ $row->id }}' />
        </td>
    </tr>
@endforeach
