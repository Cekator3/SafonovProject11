@extends('layouts.main')

@section('title', 'Заказ пользователя')

@section('styles')
{{-- Form --}}

{{-- Specific --}}
@endsection

@section('navigation')
<x-navigation.admin />
@endsection

@section('main')
<header>
    <h1>Заказ пользователя</h1>
</header>

@dump($order)

@endsection
