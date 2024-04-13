@extends('layouts.main')

@section('title', $model->getName())

@section('styles')
{{-- Form --}}
<link href="/assets/css/links/link-button.css" rel="stylesheet" type="text/css">

{{-- Specific --}}
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
    <h1>{{ $model->getName() }}</h1>
    <p>{{ $model->getDescription() }}</p>
    <a class="link button" href="#">Купить</a>
</header>

<div class="gallery">
    <img src="{{ $model->getPreviewImageUrl() }}" alt="">
</div>


@endsection
