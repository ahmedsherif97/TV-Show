@props([
    'label' => '',
    'class' => '',
    'style' => '',
    'name' => '',
    'value' => '',
    'id' => '',
    'type' => 'text',
    'placeholder' => '',
    'required',
    'multible',
    'hint' => '',
    'max' => '',
    'min' => '',
    'parentClass' => '',
    'maxlength' => '',
    'onchange',
    'scripts' => null
])
@php
    $required = isset($required) && $required == true;
    $multible = isset($multible) && $multible == true;
@endphp

<div class="mb-3 {{ $parentClass }}">
    <label class="form-label">
        {!! $label !!}
        @if ($required)
            <span class="text-danger">*</span>
        @endif
    </label>
    @php
        if (isset($value)) {
            if (is_array($value)) {
            } else {
                if ($value == '') {
                    $value = old($name, []);
                } else {
                    $value = old($name, [$value]);
                }
            }
        }
        $files = collect($value)->map(function ($item) {
            if (json_last_error() === JSON_ERROR_NONE && is_object($item)) {
                $filename = $item->file_name;
            } else {
                $filename = $item;
            }
            return [
                'source' => $filename,
                'options' => (object) ['type' => 'local'],
            ];
        });
    @endphp

    @if ($value)
        @if(isset($scripts))
            @if($scripts)
                <input type="file" class="filepond" name="{{ $name }}" data-allow-image-preview="false"
                       data-instant-upload="true" data-max-file-size="3MB" multiple data-allow-reorder="true"
                       data-files='@json($files)'>
            @else
                @foreach ($files as $file)
                    <a href="{{ @route('dashboard.application.attachment', ['application' => 20022, 'path' => $file['source'] ?? '']) }}"
                       target="_blank">Preview</a>
                @endforeach
            @endif
        @endif
    @else
        <input type="file" class="filepond" name="{{ $name }}" data-allow-image-preview="false"
               data-instant-upload="true" data-max-file-size="3MB" multiple data-allow-reorder="true"
               data-files='@json($files)'>
    @endif

    @if (false)
    @endif

    @if ($hint)
        <div class="form-text">{{ $hint }}</div>
    @endif
</div>
