{{-- Checkbox button with radio style --}}

@props(['name', 'checked' => false, 'type' => 'checkbox'])

<div class="input-field checkbox-radio">
    <input type="{{ $type }}"
           name="{{ $name }}"
           @checked($checked || old($name))
           {{ $attributes }}
    >

    {{ $slot }}
</div>
