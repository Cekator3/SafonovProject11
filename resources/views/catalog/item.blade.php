@extends('layouts.main')

@section('title', $model->getName())

@section('styles')
{{-- Form --}}
<link href="/assets/css/links/link-button.css" rel="stylesheet" type="text/css">

{{-- Specific --}}
<link href="/assets/css/catalog/item.css" rel="stylesheet" type="text/css">
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

<div class="catalog-item">
    <section class="info">
        <header><h3>{{ $model->getName() }}</h3></header>
        <p class="description">{{ $model->getDescription() }}</p>
        <x-catalog.item.actions :userRole=" $userRole "
                                :baseModelId=" $model->getId() "
                                :userCurrentOrderStatus=" $userCurrentOrderStatus " />
    </section>

    <div class="gallery">
        <img loading="lazy" src="{{ $model->getPreviewImageUrl() }}" alt="">
    </div>
</div>


@endsection
