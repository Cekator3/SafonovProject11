@extends('layouts.main')

@section('title', 'Технологии 3д-печати')

@section('styles')
{{-- Form --}}
<link href="/assets/css/form/common.css" rel="stylesheet" type="text/css">
<link href="/assets/css/form/text.css" rel="stylesheet" type="text/css">
<link href="/assets/css/form/submit.css" rel="stylesheet" type="text/css">
<link href="/assets/css/search.css" rel="stylesheet" type="text/css">

{{-- Specific --}}
<link href="/assets/css/admin/additional-services/list.css" rel="stylesheet" type="text/css">
@endsection

@section('navigation')
<x-navigation.admin />
@endsection

@section('main')
<header>
    <h1>Технологии 3д-печати</h1>

    <div class="actions">
        <x-search :placeholder=" 'Поиск' "
                :name=" 'search' "
                :url=" route('printing-technologies') "
        />

        <form method="GET" action="{{ route('printing-technologies.create') }}">
            <x-forms.submit :placeholder=" 'Создать' " />
        </form>
    </div>
</header>

<ul class="printing-technologies">
@foreach ($printingTechnologies as $printingTechnology)
<li>
    <section class="printing-technology">
        {{-- Title and description --}}
        <a href="{{ route('printing-technologies.update', ['id' => $printingTechnology->getId()]) }}">
            <header>
                <h3>{{ $printingTechnology->getName() }}</h3>
            </header>
            <p>{{ $printingTechnology->getDescription() }}</p>
        </a>

        {{-- Update and delete buttons --}}
        <div class="actions">
            <form method="GET" action="{{ route('printing-technologies.update', ['id' => $printingTechnology->getId()]) }}">
                <x-forms.submit :placeholder=" 'Изменить' " />
            </form>

            <form method="POST" action="{{ route('printing-technologies.delete', ['id' => $printingTechnology->getId()]) }}">
                @csrf
                @method('DELETE')
                <x-forms.submit :placeholder=" 'Удалить' " />
            </form>
        </div>
    </section>
</li>
@endforeach
</ul>

@endsection
