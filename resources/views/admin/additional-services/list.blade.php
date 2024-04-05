@extends('layouts.main')

@section('title', 'Дополнительные услуги')

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
    <h1>Дополнительные услуги</h1>

    <div class="actions">
        <x-search :placeholder=" 'Поиск' "
                :name=" 'search' "
                :url=" route('additional-services') "
        />

        <form method="GET" action="{{ route('additional-services.create') }}">
            <x-forms.submit :placeholder=" 'Создать' " />
        </form>
    </div>
</header>



<ul class="additional-services">
@foreach ($additionalServices as $additionalService)
<li>
    <section class="additional-service">
        {{-- Preview image, title and description --}}
        <a href="{{ route('additional-services.update', ['id' => $additionalService->getId()]) }}">
            <img src="{{ $additionalService->getPreviewImageUrl() }}">
            <header>
                <h3>{{ $additionalService->getName() }}</h3>
            </header>
            <p>{{ $additionalService->getDescription() }}</p>
        </a>

        {{-- Update and delete buttons --}}
        <div class="actions">
            <form method="GET" action="{{ route('additional-services.update', ['id' => $additionalService->getId()]) }}">
                <x-forms.submit :placeholder=" 'Изменить' " />
            </form>

            <form method="POST" action="{{ route('additional-services.delete', ['id' => $additionalService->getId()]) }}">
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
