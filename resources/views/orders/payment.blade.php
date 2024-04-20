@extends('layouts.main')

@section('title', 'Оплата заказа')

@section('navigation')
<x-navigation.customer />
@endsection

@section('main')

{{-- Order info --}}
<h1>Заказ №{!! $orderId !!}</h1>
<p>Переведите деньги на номер телевона 706(572)126-71-72, указав при переводе номер заказа и контактные данные, по которым с вами можно связаться по окончании выполнения заказа. Если у вас возникнут проблемы, не стесняйтесь обращаться по электронной почте Sobutilnik@work.ru.</p>
<aside>Ваш номер заказа: {!! $orderId !!}</aside>

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
    font-family: Manrope;
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
