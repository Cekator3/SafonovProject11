@props(['name', 'url'])

<section role="search">
<form action="{{ $url }}" method="GET">
    <input type="search" name="{{ $name }}" id="{{ $name }}" required autocomplete="off" {{ $attributes }}>
    <button type="submit"><img src="/assets/images/search.svg" alt=""></button>
</form>
</section>
