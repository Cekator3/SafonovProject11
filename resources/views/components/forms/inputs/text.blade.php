{{-- Text input field --}}

@props(['type' => 'text', 'name', 'placeholder', 'value' => null])

<div class="input-field text @error($name) has-errors @enderror">
    <input type="{{ $type }}"
           id="{{ $name }}"
           name="{{ $name }}"
           value="{{ $value ?? old($name) }}"
           placeholder=""
           {{ $attributes }}
    >
    <label for="{{ $name }}">{{ $placeholder }}</label>
    <ul class="errors">
        @foreach ($errors->get($name) as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
</div>
