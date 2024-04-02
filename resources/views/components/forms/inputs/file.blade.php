{{-- File input field --}}

@props(['name', 'placeholder'])

<div class="input-field file @error($name) has-errors @enderror">
    <input type="file"
           id="{{ $name }}"
           name="{{ $name }}"
           {{ $attributes }}
    >
    <ul class="errors">
        @foreach ($errors->get($name) as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
</div>
