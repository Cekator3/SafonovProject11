@extends('layouts.main')

@section('title', 'Типы филаментов')

@section('styles')
{{-- Form --}}
<link href="/assets/css/form/common.css" rel="stylesheet" type="text/css">
<link href="/assets/css/form/text.css" rel="stylesheet" type="text/css">
<link href="/assets/css/form/submit.css" rel="stylesheet" type="text/css">
<link href="/assets/css/search.css" rel="stylesheet" type="text/css">

{{-- Specific --}}
<link href="/assets/css/admin/filament-types/list.css" rel="stylesheet" type="text/css">
@endsection

@section('navigation')
<x-navigation.admin />
@endsection

@section('main')
<header>
    <h1>Типы филаментов</h1>

    <div class="actions">
        <x-search :placeholder=" 'Поиск' "
                :name=" 'search' "
                :url=" route('filament-types') "
        />

        <form method="GET" action="{{ route('filament-types.create') }}">
            <x-forms.submit :placeholder=" 'Создать' " />
        </form>
    </div>
</header>

<ul class="filament-types">
@foreach ($filamentTypes as $filamentType)
<li>
    <section class="filament-type">
        {{-- Title and description --}}
        <a href="{{ route('filament-types.update', ['id' => $filamentType->getId()]) }}">
            <header>
                <h3>{{ $filamentType->getName() }}</h3>
            </header>
        </a>

        <section class="printing-technologies">
            <header><h4>Технологии печати, в которых он может использоваться</h4></header>
            <ul>
            @foreach ($filamentType->getPrintingTechnologies() as $printingTechnology)
                <a href="{{ route('printing-technologies.update', ['id' => $printingTechnology->getId()]) }}">
                <li>{{ $printingTechnology->getName() }}</li>
                </a>
            @endforeach
            </ul>
        </section>

        {{-- Update and delete buttons --}}
        <footer class="actions">
            <form method="GET" action="{{ route('filament-types.update', ['id' => $filamentType->getId()]) }}">
                <x-forms.submit :placeholder=" 'Изменить' " />
            </form>

            <form method="POST" action="{{ route('filament-types.delete', ['id' => $filamentType->getId()]) }}">
                @csrf
                @method('DELETE')
                <x-forms.submit :placeholder=" 'Удалить' " />
            </form>
        </footer>
    </section>
</li>
@endforeach
</ul>

@endsection
