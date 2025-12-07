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

    $schedules = old('schedules');

    if (is_null($schedules)) {
        if (isset($tvshow) && $tvshow->relationLoaded('schedules') && $tvshow->schedules->count()) {
            $schedules = $tvshow->schedules->sortBy('day_of_week')->map(function ($schedule) {
                return [
                    'day_of_week' => $schedule->day_of_week,
                    'start_time'  => substr($schedule->start_time, 0, 5),
                ];
            })->toArray();
        } else {
            $schedules = [
                ['day_of_week' => null, 'start_time' => null],
            ];
        }
    }
@endphp

<div class="row g-3">
    <div class="col-sm-6">
        <x-dashboard.forms.input
                type="text"
                label="Title"
                name="title"
                value="{{ old('title', $tvshow->title ?? '') }}"
                placeholder="Enter show title"
                required="true"
        />
    </div>

    <div class="col-sm-6">
        <x-dashboard.forms.input
                type="text"
                label="Slug"
                name="slug"
                value="{{ old('slug', $tvshow->slug ?? '') }}"
                placeholder="Enter slug"
                required="true"
        />
    </div>

    <div class="mb-3 mt-3 col-sm-6">
        <label class="form-label d-block mb-1">
            Status <span class="text-danger">*</span>
        </label>
        <div class="form-check form-switch form-switch-success">
            <input type="hidden" name="is_active" value="0">
            <input
                    class="form-check-input"
                    type="checkbox"
                    id="isActiveSwitch"
                    name="is_active"
                    value="1"
                    {{ old('is_active', $tvshow->is_active ?? true) ? 'checked' : '' }}
            >
            <label class="form-check-label" for="isActiveSwitch">
                Active
            </label>
        </div>
    </div>
</div>

<div class="mb-3">
    <label class="form-label" for="description">
        Description
    </label>
    <textarea
            id="description"
            name="description"
            class="form-control"
            placeholder="Enter show description"
    >{{ old('description', $tvshow->description ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label class="form-label d-block">
        Show Schedule
    </label>

    <div id="schedule-repeater" class="row g-3">
        @foreach($schedules as $index => $schedule)
            <div class="col-md-4 schedule-item">
                <label class="form-label">Day</label>
                <select name="schedules[{{ $index }}][day_of_week]" class="form-select">
                    <option value="">Select day</option>
                    @foreach($daysEn as $dayValue => $dayLabel)
                        <option value="{{ $dayValue }}"
                                {{ (string)($schedule['day_of_week'] ?? '') === (string)$dayValue ? 'selected' : '' }}>
                            {{ $dayLabel }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 schedule-item">
                <label class="form-label">Airing Time</label>
                <input
                        type="time"
                        name="schedules[{{ $index }}][start_time]"
                        class="form-control"
                        value="{{ $schedule['start_time'] ?? '' }}"
                >
            </div>
            <div class="col-md-4 d-flex align-items-end schedule-item">
                <button type="button" class="btn btn-outline-danger btn-remove-schedule w-100">
                    Remove
                </button>
            </div>
        @endforeach
    </div>

    <div class="mt-3">
        <button type="button" class="btn btn-outline-primary" id="add-schedule-row">
            Add Schedule
        </button>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var repeater = document.getElementById('schedule-repeater');
            var addBtn = document.getElementById('add-schedule-row');
            var days = @json($daysEn);

            function getNextIndex() {
                var inputs = repeater.querySelectorAll('[name^="schedules["][name$="][day_of_week]"]');
                if (!inputs.length) return 0;
                var max = 0;
                inputs.forEach(function (input) {
                    var match = input.name.match(/schedules\[(\d+)]/);
                    if (match) {
                        var idx = parseInt(match[1], 10);
                        if (idx > max) max = idx;
                    }
                });
                return max + 1;
            }

            function bindRemoveButtons() {
                var removeButtons = repeater.querySelectorAll('.btn-remove-schedule');
                removeButtons.forEach(function (btn) {
                    btn.onclick = function () {
                        var item = btn.closest('.row');
                    };
                });
            }

            addBtn.addEventListener('click', function () {
                var index = getNextIndex();

                var row = document.createElement('div');
                row.className = 'row g-3 mt-2 schedule-row';

                var colDay = document.createElement('div');
                colDay.className = 'col-md-4';
                var labelDay = document.createElement('label');
                labelDay.className = 'form-label';
                labelDay.textContent = 'Day';
                var select = document.createElement('select');
                select.name = 'schedules[' + index + '][day_of_week]';
                select.className = 'form-select';
                var optionEmpty = document.createElement('option');
                optionEmpty.value = '';
                optionEmpty.textContent = 'Select day';
                select.appendChild(optionEmpty);
                Object.keys(days).forEach(function (key) {
                    var opt = document.createElement('option');
                    opt.value = key;
                    opt.textContent = days[key];
                    select.appendChild(opt);
                });
                colDay.appendChild(labelDay);
                colDay.appendChild(select);

                var colTime = document.createElement('div');
                colTime.className = 'col-md-4';
                var labelTime = document.createElement('label');
                labelTime.className = 'form-label';
                labelTime.textContent = 'Airing Time';
                var inputTime = document.createElement('input');
                inputTime.type = 'time';
                inputTime.name = 'schedules[' + index + '][start_time]';
                inputTime.className = 'form-control';
                colTime.appendChild(labelTime);
                colTime.appendChild(inputTime);

                var colRemove = document.createElement('div');
                colRemove.className = 'col-md-4 d-flex align-items-end';
                var btnRemove = document.createElement('button');
                btnRemove.type = 'button';
                btnRemove.className = 'btn btn-outline-danger w-100';
                btnRemove.textContent = 'Remove';
                btnRemove.onclick = function () {
                    row.remove();
                };
                colRemove.appendChild(btnRemove);

                row.appendChild(colDay);
                row.appendChild(colTime);
                row.appendChild(colRemove);

                repeater.appendChild(row);
            });

            var existingRemoveButtons = repeater.querySelectorAll('.btn-remove-schedule');
            existingRemoveButtons.forEach(function (btn) {
                btn.addEventListener('click', function () {
                    var col = btn.closest('.schedule-item');
                    var row = col.parentElement;
                    row.remove();
                });
            });
        });
    </script>
@endpush
