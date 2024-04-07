{{-- Star rating input field --}}

@props(['name'])

<div class="input-field star-rate">
    <input type="radio" id="star5" name="{{ $name }}" value="5" />
    <label for="star5"></label>

    <input type="radio" id="star4" name="{{ $name }}" value="4" />
    <label for="star4"></label>

    <input type="radio" id="star3" name="{{ $name }}" value="3" />
    <label for="star3"></label>

    <input type="radio" id="star2" name="{{ $name }}" value="2" />
    <label for="star2"></label>

    <input type="radio" id="star1" name="{{ $name }}" value="1" />
    <label for="star1"></label>
</div>
