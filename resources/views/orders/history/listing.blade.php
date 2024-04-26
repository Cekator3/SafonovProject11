@extends('layouts.main')

@section('title', 'История заказов')

@section('styles')
<link href="/assets/css/admin/orders/listing.css" rel="stylesheet" type="text/css">
@endsection

@section('navigation')
<x-navigation.customer />
@endsection

@section('main')
<h1>История заказов</h1>

<table>
    <thead>
        <tr>
        <th>№</th>
        <th>Статус</th>
        <th>Дата оплаты</th>
        <th>Дата завершения</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
        @php
            $href = route('orders.history.item', ['orderId' => $order->getId()]);
        @endphp
            <tr>
            <td><a href="{!! $href !!}">{!! $order->getId() !!}</a></td>
            <td><a href="{!! $href !!}">{!! $order->getStatus() !!}</a></td>
            <td><a href="{!! $href !!}">{!! $order->getPaymentDate() !!}</a></td>
            <td><a href="{!! $href !!}">{!! $order->getCompletionDate() !!}</a></td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
