@extends('layouts.main')

@section('title', 'Создание модельки')

@section('styles')
{{-- Form --}}

{{-- Specific --}}
@endsection

@section('navigation')
<x-navigation.admin />
@endsection

@section('main')
<header>
    <h1>Создание модельки</h1>
</header>

<form method="POST" action="{{ route('base-models.create') }}" >
    @csrf

    {{-- ... --}}

    <x-forms.submit :placeholder=" 'Создать' " />
</form>
@endsection
