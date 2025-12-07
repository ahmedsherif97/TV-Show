@foreach ($result as $index => $row)
    <tr>
        <td data-column="id"></td>
        <td data-column="name">{{ $row->name }}</td>
        <td data-column="actions">
            <x-dashboard.table.actions module='permission' id='{{ $row->id }}' />
        </td>
    </tr>
@endforeach
