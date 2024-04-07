{{-- Star rating input field --}}

@props(['name', 'value' => null])

<div class="input-field star-rate">
    <input type="radio" id="{{ $name }}_5" name="{{ $name }}" value="5" @checked($value === 5) />
    <label for="{{ $name }}_5"></label>

    <input type="radio" id="{{ $name }}_4" name="{{ $name }}" value="4" @checked($value === 4) />
    <label for="{{ $name }}_4"></label>

    <input type="radio" id="{{ $name }}_3" name="{{ $name }}" value="3" @checked($value === 3) />
    <label for="{{ $name }}_3"></label>

    <input type="radio" id="{{ $name }}_2" name="{{ $name }}" value="2" @checked($value === 2) />
    <label for="{{ $name }}_2"></label>

    <input type="radio" id="{{ $name }}_1" name="{{ $name }}" value="1" @checked($value === 1) />
    <label for="{{ $name }}_1"></label>
</div>
