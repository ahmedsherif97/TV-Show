@props([
    'label' => '',
    'class' => '',
    'name' => '',
    'checked' => false,
    'value' => '',
    'type' => 'text',
    'placeholder' => '',
    'required',
    'hint' => '',
    'parentClass' => '',
    'onchange',
])
@php
    $required = isset($required) && $required == true;
    $checked = isset($checked) && $checked == true;
@endphp

<div class="mb-3 form-check {{ $parentClass }}">

    <input type="{{ $type }}" class="form-check-input {{ $class }}" id="{{ $name }}Id"
        name="{{ $name }}" value="{{ $value ? $value : old($name) }}" placeholder="{!! $placeholder !!}"
        {{ $required ? 'required' : '' }}
        {{ $checked ? 'checked' : '' }}
        @isset($onchange) onchange="{{ $onchange }}" @endisset />
    <label class="form-check-label" for="{{ $name }}Id">
        {!! $label !!}
    </label>

    @if ($hint)
        <div class="form-text">{{ $hint }}</div>
    @endif
</div>

{{ $slot }}
