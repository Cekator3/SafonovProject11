{{-- Checkbox button with radio style --}}

@props(['name', 'placeholder', 'id' => null, 'checked' => false, 'type' => 'checkbox'])

<div class="input-field checkbox-radio">
    <input type="{{ $type }}"
           name="{{ $name }}"
           id="{{ $id ?? $name }}"
           @checked($checked || old($name))
           {{ $attributes }}
    >
    <label for="{{ $id ?? $name }}">{!! $placeholder !!}</label>
</div>
