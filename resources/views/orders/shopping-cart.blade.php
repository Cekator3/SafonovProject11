@extends('layouts.main')

@section('title', 'Корзина')

@section('styles')
{{-- Form --}}
<link href="/assets/css/form/common.css" rel="stylesheet" type="text/css">
<link href="/assets/css/form/submit.css" rel="stylesheet" type="text/css">
<link href="/assets/css/links/link-button.css" rel="stylesheet" type="text/css">

{{-- Specific --}}
@endsection

@section('navigation')
<x-navigation.customer />
@endsection

@section('scripts')
<script src="https://kit.fontawesome.com/e2c11c87a0.js" crossorigin="anonymous"></script>
@endsection

@section('main')
<h1>Корзина</h1>

{{-- Order --}}
<article>
    {{-- Order info --}}
    <header>
        <h2>Заказ №{{ $shoppingCart->getOrderId() }}</h2>
        <span class="status">{{ $shoppingCart->getOrderStatus() }}</span>
    </header>

    {{-- Ordered models --}}
    @foreach ($shoppingCart->getModels() as $model)
    <section>
        <header>
            <h3>{{ $model->getName() }}</h3>
            <span class="edit">
                <a href="{!! route('shopping-cart.update', ['orderedModelId' => $model->getId()]) !!}">
                    <i class="fa-solid fa-pencil"></i>
                </a>
            </span>
            <span class="remove">
                <a href="{!! route('shopping-cart.remove', ['orderedModelId' => $model->getId()]) !!}">
                    <i class="fa-solid fa-trash"></i>
                </a>
            </span>
            <span class="amount">{!! $model->getAmount() !!} шт.</span>
        </header>

        <img loading="lazy" src="{!! $model->getThumbnailUrl() !!}" alt="">

        <footer>
            <p>{!! $model->getPrice() !!}</p>
        </footer>
    </section>
    @endforeach

    {{-- Order's summary --}}
    <footer>
        <p>Сумма к оплате: {!! $shoppingCart->getTotalPrice() !!}</p>
    </footer>
</article>

<a class="link button" href="#">Оформить заказ</a>
@endsection
