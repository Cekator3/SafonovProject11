@extends('layouts.main')

@section('title', 'Заказ №'.$order->getId())

@section('styles')
{{-- Form --}}
<link href="/assets/css/form/common.css" rel="stylesheet" type="text/css">
<link href="/assets/css/form/fieldset.css" rel="stylesheet" type="text/css">
<link href="/assets/css/form/checkbox-radio.css" rel="stylesheet" type="text/css">
<link href="/assets/css/form/submit.css" rel="stylesheet" type="text/css">

{{-- Specific --}}
<link href="/assets/css/admin/orders/order-details.css" rel="stylesheet" type="text/css">
@endsection

@section('navigation')
<x-navigation.customer />
@endsection

@section('main')
<header>
    <h1>Заказ №{!! $order->getId() !!}</h1>
    <span class="status">{!! $order->getStatusAsString() !!}</span>
</header>

<section class="order-info">
    @if ($order->isPayed() || $order->isCompleted())
        <h2>Детали заказа</h2>
    @endif
    @if ($order->isPayed())
        <p>Дата оплаты: <time>{!! $order->getPaymentDate() !!}</time></p>
    @endif
    @if ($order->isCompleted())
        <p>Дата выполнения: <time>{!! $order->getCompletionDate() !!}</time></p>
    @endif

{{-- Ordered models --}}
<article>
    <h2>Модельки заказа</h2>
    @foreach ($order->getModels() as $model)
    <section class="ordered-models">
        <header>
            <h3><a href="{!! route('catalog.item', ['baseModelId' => $model->getId()]) !!}">{{ $model->getName() }}</a></h3>
            <details open>
                <summary>Подробнее</summary>
                <p>Технология печати: {{ $model->getPrintingTechnologyName() }}</p>
                <p>Тип филамента: {{ $model->getFilamentTypeName() }}</p>
                <p>Цвет: <span class="color" style="background: {!! $model->getColorAsRgbCss() !!}"></span></p>
                <p>Размер: {!! $model->getSizeMultiplier().'%'.' ('.$model->getLength().'X'.$model->getWidth().'x'.$model->getHeight().' мм)' !!}</p>
                <p>Количество: {!! $model->getAmount() !!} шт.</p>
                @if ($model->hasAnyAdditionalServices())
                    <section>
                        <h3>Дополнительные услуги</h3>
                        <ul>
                            @foreach ($model->getAdditionalServices() as $additionalService)
                            <li>{{ $additionalService->getName() }}</li>
                            @endforeach
                        </ul>
                    </section>
                @endif
            </details>
        </header>

        <img loading="lazy" src="{!! $model->getThumbnailUrl() !!}" alt="">
    </section>
    @endforeach
</article>



@endsection
