@php
    $airingAtValue = old('airing_at', isset($episode) && $episode->airing_at ? \Carbon\Carbon::parse($episode->airing_at)->format('Y-m-d\TH:i') : '');
    $duration = $episode->duration_seconds ?? 0;
    $durationLabel = $duration > 0 ? gmdate('H:i:s', $duration) : '-';
@endphp

<div class="row g-3">
    <div class="col-sm-6">
        <label class="form-label">
            {{ __('tvshow::dashboard.tvshow') }} <span class="text-danger">*</span>
        </label>
        <select name="tv_show_id" class="form-select" required>
            <option value="">{{ __('dashboard.select') }}</option>
            @foreach($tvShows ?? [] as $id => $title)
                <option value="{{ $id }}"
                        {{ (string)old('tv_show_id', $episode->tv_show_id ?? '') === (string)$id ? 'selected' : '' }}>
                    {{ $title }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-sm-6">
        <x-dashboard.forms.input
                type="text"
                label="{{ __('dashboard.title') }}"
                name="title"
                value="{{ old('title', $episode->title ?? '') }}"
                placeholder="{{ __('dashboard.title') }}"
                required="true"
        />
    </div>

    <div class="col-sm-6">
        <x-dashboard.forms.input
                type="text"
                label="{{ __('dashboard.slug') }}"
                name="slug"
                value="{{ old('slug', $episode->slug ?? '') }}"
                placeholder="{{ __('dashboard.slug') }}"
                required="true"
        />
    </div>

    <div class="col-sm-6">
        <label class="form-label">
            {{ __('episode::dashboard.airing_at') }}
        </label>
        <input
                type="datetime-local"
                name="airing_at"
                class="form-control"
                value="{{ $airingAtValue }}"
        >
        <small class="text-muted d-block">
            Example: Monday @ 8:30 PM
        </small>
    </div>

    <div class="col-sm-6">
        <label class="form-label d-block">
            {{ __('episode::dashboard.duration') }}
        </label>
        <input type="text" class="form-control" value="{{ $durationLabel }}" disabled>
        <small class="text-muted d-block">
            {{ __('episode::dashboard.duration') }}
        </small>
    </div>

    <div class="col-sm-6">
        <x-dashboard.image-uploaded
                name="thumbnail"
                :multiple="false"
                :required="false"
                :existingImages="isset($episode) ? $episode->getMedia('thumbnail') : null"
        />
    </div>
</div>

<div class="mb-3 mt-3">
    <label class="form-label" for="description">
        {{ __('dashboard.description') }}
    </label>
    <textarea
            id="description"
            name="description"
            class="form-control"
            placeholder="{{ __('dashboard.description') }}"
    >{{ old('description', $episode->description ?? '') }}</textarea>
</div>
