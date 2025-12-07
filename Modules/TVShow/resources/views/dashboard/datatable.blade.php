@php
    $daysEn = [
        0 => 'Sunday',
        1 => 'Monday',
        2 => 'Tuesday',
        3 => 'Wednesday',
        4 => 'Thursday',
        5 => 'Friday',
        6 => 'Saturday',
    ];
@endphp

@foreach ($result as $index => $row)
    @php
        $hasSchedule = $row->schedules && $row->schedules->count();
    @endphp

    <tr>
        <td data-column="id"></td>

        <td data-column="title">{{ $row->title }}</td>

        <td data-column="slug">
            <span class="badge bg-label-info">{{ $row->slug }}</span>
        </td>

        <td data-column="schedule">
            @if($hasSchedule)
                <button type="button"
                        class="btn btn-sm btn-outline-info"
                        data-bs-toggle="modal"
                        data-bs-target="#showScheduleModal-{{ $row->id }}">
                    View Schedule
                </button>

                <div class="modal fade" id="showScheduleModal-{{ $row->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">{{ $row->title }} Schedule</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <ul class="list-unstyled mb-0">
                                    @foreach($row->schedules->sortBy('day_of_week') as $schedule)
                                        @php
                                            $timeLabel = \Carbon\Carbon::createFromFormat('H:i:s', $schedule->start_time)->format('g:i A');
                                        @endphp
                                        <li>
                                            {{ $daysEn[$schedule->day_of_week] ?? $schedule->day_of_week }}
                                            @ {{ $timeLabel }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                                    Close
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <span class="text-muted">No Schedule</span>
            @endif
        </td>

        <td data-column="is_active">
            @if($row->is_active)
                <span class="badge bg-success">Active</span>
            @else
                <span class="badge bg-danger">Inactive</span>
            @endif
        </td>

        <td data-column="actions">
            <x-dashboard.table.actions module="show" id="{{ $row->id }}"/>
        </td>
    </tr>
@endforeach
