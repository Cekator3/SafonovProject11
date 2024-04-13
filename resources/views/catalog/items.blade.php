@extends('layouts.main')

@section('title', 'Каталог')

@section('styles')
{{-- Form --}}
<link href="/assets/css/form/common.css" rel="stylesheet" type="text/css">
<link href="/assets/css/form/submit.css" rel="stylesheet" type="text/css">
<link href="/assets/css/search.css" rel="stylesheet" type="text/css">

{{-- Specific --}}
<link href="/assets/css/catalog/items.css" rel="stylesheet" type="text/css">
@endsection

@section('navigation')
@switch($userRole)
    @case(App\Enums\UserRole::Guest)
        <x-navigation.guest />
        @break
    @case(App\Enums\UserRole::Customer)
        <x-navigation.customer />
        @break
    @case(App\Enums\UserRole::Admin)
        <x-navigation.admin />
        @break
@endswitch
@endsection

@section('main')
<header>
    <h1>Каталог</h1>

    <div class="actions">
        <x-search :placeholder=" 'Поиск' "
                :name=" 'search' "
                :url=" route('catalog') "
        />
    </div>
</header>

<ul class='models'>
@foreach ($models as $model)
<li>
    <section class="model">
        {{-- Title and description --}}
        <a href="#">
            {{-- Preview image and title --}}
            <img loading="lazy" src="{{ $model->getPreviewImageUrl() }}">
            <header>
                <h3>{{ $model->getName() }}</h3>
            </header>
        </a>
    </section>
</li>
@endforeach
</ul>

@endsection
