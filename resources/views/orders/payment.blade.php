@extends('layouts.main')

@section('title', 'Оплата заказа')

@section('navigation')
<x-navigation.customer />
@endsection

@section('main')

{{-- Order info --}}
<h1>Заказ №{!! $shoppingCart->getOrderId() !!}</h1>
<p>
    Для оплаты заказа №{!! $shoppingCart->getOrderId() !!}, нужно перевести на карту 3742 4545 5400 1261 в банк Тинькофф
    сумму, равную {!! $shoppingCart->getTotalPrice() !!} рублей.
    После оплаты с вами свяжется оператор для дальнейшего продвижения заказа.
    Если у вас возникнут проблемы, не стесняйтесь обращаться по электронной почте Sobutilnik@work.ru.
</p>

<style>
main
{
    display: flex;
    flex-flow: column nowrap;
    justify-content: center;
    align-content: center;
    height: 78%;
}
h1
{
    font-size: 30px;
    font-weight: 700;
    line-height: 40.98px;
    text-align: center;
    margin: 0 0 12px 0;
}
p, aside
{
    font-size: 16px;
    font-weight: 400;
    line-height: 21.86px;
    text-align: center;
    color: #FFFFFFB2;
}
p
{
    margin: 0 0 12px 0;
}
</style>

@endsection
