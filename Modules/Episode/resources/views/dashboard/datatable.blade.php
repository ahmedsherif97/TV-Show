@foreach ($result as $index => $row)
    @php
        $videoUrl = $row->getFirstMediaUrl('video');
        $airingLabel = '-';
        if ($row->airing_at) {
            $airingLabel = \Carbon\Carbon::parse($row->airing_at)->format('l @ g:i A');
        }
        $duration = $row->duration_seconds ?? 0;
        $durationLabel = $duration > 0 ? gmdate('H:i:s', $duration) : '-';
    @endphp

    <tr>
        <td data-column="id"></td>

        <td data-column="title">
            {{ $row->title }}
        </td>

        <td data-column="tv_show">
            {{ $row->tvShow->title ?? '-' }}
        </td>

        <td data-column="airing_at">
            {{ $airingLabel }}
        </td>

        <td data-column="duration">
            {{ $durationLabel }}
        </td>

        <td data-column="video">
            @can('update episode')
                <a href="{{ route('dashboard.episode.video', $row->id) }}"
                   class="btn btn-sm btn-outline-primary">
                    {{ __('episode::dashboard.manage_video') }}
                </a>
            @endcan
        </td>

        <td data-column="actions">
            <x-dashboard.table.actions module="episode" id="{{ $row->id }}"/>
        </td>
    </tr>
@endforeach
