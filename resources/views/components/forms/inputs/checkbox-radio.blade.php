{{-- Checkbox button with radio style --}}

@props(['name', 'placeholder', 'id' => null])

<div class="input-field checkbox-radio">
    <input type="checkbox"
           name="{{ $name }}"
           id="{{ $id ?? $name }}"
           @checked(old($name))
           {{ $attributes }}
    >
    <label for="{{ $id ?? $name }}">{{ $placeholder }}</label>
</div>
