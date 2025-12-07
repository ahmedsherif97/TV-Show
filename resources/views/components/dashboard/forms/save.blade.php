@props([
    'label' => '',
    'class' => '',
    'name' => '',
    'type' => 'text',
    'placeholder' => '',
    'required' => false,
    'hint' => '',
    'form',
])

<div class="pt-4 text-center">
    <button type="submit" class="btn btn-primary mx-1"
        @isset($form) form="{{ $form }}" @endisset>
        <span class="bx bx-save me-1"></span>
        {{ __('dashboard.save') }}
    </button>
    <button type="reset" class="btn btn-label-secondary mx-1">
        <span class="bx bx-undo me-1"></span>
        {{ __('dashboard.reset') }}
    </button>
    {{ $slot }}
</div>
