@foreach ($result as $index => $row)
    <tr>
        <td data-column="id">{{ $result->firstItem() + $index }}</td>
        <td data-column="type">
            <div class="text-center">{{ $row->type }}</div>
        </td>
        <td data-column="data">
            <div class="text-center">{{ $row->data }}</div>
        </td>
    </tr>
@endforeach