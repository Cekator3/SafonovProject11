@props(['name', 'placeholder', 'url'])

<section role="search">
    <form action="{{ $url }}" method="GET">
        <x-forms.inputs.text :type=" 'search' "
                             :$name
                             :$placeholder
                             required=""
                             {{ $attributes }}
        />
        <x-forms.submit :placeholder=" 'Поиск' " />
    </form>
</section>
