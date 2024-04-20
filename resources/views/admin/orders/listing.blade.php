@extends('layouts.main')

@section('title', 'Заказы')

@section('styles')
{{-- Form --}}

{{-- Specific --}}
@endsection

@section('navigation')
<x-navigation.admin />
@endsection

@section('main')
<header>
    <h1>Заказы</h1>
</header>

@dump($orders)

@endsection
