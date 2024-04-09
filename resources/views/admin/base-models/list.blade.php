@extends('layouts.main')

@section('title', 'Модельки')

@section('styles')
{{-- Form --}}
<link href="/assets/css/form/common.css" rel="stylesheet" type="text/css">
<link href="/assets/css/form/text.css" rel="stylesheet" type="text/css">
<link href="/assets/css/form/submit.css" rel="stylesheet" type="text/css">
<link href="/assets/css/search.css" rel="stylesheet" type="text/css">

{{-- Specific --}}
<link href="/assets/css/admin/base-models/list.css" rel="stylesheet" type="text/css">
@endsection

@section('navigation')
<x-navigation.admin />
@endsection

@section('main')
<header>
    <h1>Модельки</h1>

    <div class="actions">
        <x-search :placeholder=" 'Поиск' "
                :name=" 'search' "
                :url=" route('base-models') "
        />

        <form method="GET" action="{{ route('base-models.create') }}">
            <x-forms.submit :placeholder=" 'Создать' " />
        </form>
    </div>
</header>

<ul class='base-models'>
@foreach ($baseModels as $baseModel)
<li>
    <section class="base-model">
        {{-- Title and description --}}
        <a href="{{ route('base-models.update', ['id' => $baseModel->getId()]) }}">
            {{-- Preview image and title --}}
            <img loading="lazy" src="{{ $baseModel->getPreviewImageUrl() }}">
            <header>
                <h3>{{ $baseModel->getName() }}</h3>
            </header>
        </a>

        {{-- Update and delete buttons --}}
        <footer class="actions">
            <form method="GET" action="{{ route('base-models.update', ['id' => $baseModel->getId()]) }}">
                <x-forms.submit :placeholder=" 'Изменить' " />
            </form>

            <form method="POST" action="{{ route('base-models.delete', ['id' => $baseModel->getId()]) }}">
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
