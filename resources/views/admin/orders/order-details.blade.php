@extends('layouts.main')

@section('title', 'Заказ пользователя')

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
<x-navigation.admin />
@endsection

@section('main')
<header>
    <h1>Заказ №{!! $order->getId() !!}</h1>
    <span class="status">{!! $order->getStatusAsString() !!}</span>
</header>

<section class="order-info">
    <h2>Детали заказа</h2>
    <p>Заказчик: {{ $order->getCustomerEmail() }}</p>
    @if ($order->isPayed())
        <p>Дата оплаты: <time>{!! $order->getPaymentDate() !!}</time></p>
    @endif
    @if ($order->isCompleted())
        <p>Дата выполнения: <time>{!! $order->getCompletionDate() !!}</time></p>
    @endif

    <form method="post" action="{!! route('admin.orders.setStatus', ['orderId' => $order->getId()]) !!}">
        @csrf
        @method('PUT')

        <fieldset>
            <legend>Статус заказа</legend>
            @foreach ($order->getAllStatuses() as $status)
                    <x-forms.inputs.checkbox-radio :type=" 'radio' "
                                                   :name=" 'status' "
                                                   :id=" 'status-'.$loop->index "
                                                   :placeholder=" $order->getStatusString($status) "
                                                   :checked=" $order->getStatus() === $status "
                                                   value="{!! $status->value !!}"
                                                   required
                    />
            @endforeach
        </fieldset>
        <x-forms.submit :placeholder=" 'Сохранить' " />
    </form>
</section>

{{-- Ordered models --}}
<article>
    <h2>Модельки заказа</h2>
    @foreach ($order->getModels() as $model)
    <section class="ordered-models">
        <header>
            <h3><a href="{!! route('base-models.update', ['id' => $model->getId()]) !!}">{{ $model->getName() }}</a></h3>
            <details open>
                <summary>Подробнее</summary>
                <p>Технология печати: <a href="{!! route('printing-technologies.update', ['id' => $model->getPrintingTechnologyId()]) !!}">{{ $model->getPrintingTechnologyName() }}</a></p>
                <p>Тип филамента: <a href="{!! route('filament-types.update', ['id' => $model->getFilamentTypeId()]) !!}">{{ $model->getFilamentTypeName() }}</a></p>
                <p>Цвет: <span class="color" style="background: {!! $model->getColorAsRgbCss() !!}"></span></p>
                <p>Размер: {!! $model->getSizeMultiplier().'%'.' ('.$model->getLength().'X'.$model->getWidth().'x'.$model->getHeight().' мм)' !!}</p>
                @if ($model->hasAnyAdditionalServices())
                    <section>
                        <h3>Дополнительные услуги</h3>
                        <ul>
                            @foreach ($model->getAdditionalServices() as $additionalService)
                            <li><a href="{!! route('additional-services.update', ['id' => $additionalService->getId()]) !!}">{{ $additionalService->getName() }}</a></li>
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
