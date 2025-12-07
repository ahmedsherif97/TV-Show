@foreach ($result as $row)
    <tr>
        <td data-column="id">{{ $row->id ?? '' }}</td>
        <td data-column="name">{{ $row->name ?? '' }}</td>
    </tr>
@endforeach
