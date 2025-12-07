@props([
    'id' => '',
    'label' => '',
    'class' => '',
    'name' => '',
    'value' => '',
    'type' => 'text',
    'placeholder' => '',
    'required',
    'multiple',
    'disabled',
    'hint' => '',
    'parentClass' => '',
    'options' => [],
    'onchange',
])
@php
    $required = isset($required);
    $multiple = isset($multiple);
    $disabled = isset($disabled) && $disabled;
@endphp

<div class="mb-3 {{ $parentClass }}">
    <label class="form-label">
        {{ $label }}
        @if ($required)
            <span class="text-danger">*</span>
        @endif
    </label>
    <select class="form-select select2 {{ $class }}" data-allow-clear="true"
            @if ($id) id="{{ $id }}" @endif name="{{ $name }}"
            @if ($placeholder) data-placeholder="{{ $placeholder }}" @endif placeholder="{{ $placeholder }}"
            {{ $required ? 'required' : '' }} {{ $multiple ? 'multiple' : '' }} {{ $disabled ? 'disabled' : '' }}
            @isset($onchange) onchange="{{ $onchange }}" @endisset>
        @foreach ($options ?? [] as $key => $text)
            <option value="{{ $key }}" {{ $key == $value ? 'selected' : '' }}>{{ $text }}</option>
        @endforeach
        {{ $slot }}
    </select>

    @if ($hint)
        <div class="form-text">{{ $hint }}</div>
    @endif
</div>
