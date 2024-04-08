@extends('layouts.main')

@section('title', 'Изменение модельки')

@section('styles')
{{-- Form --}}

{{-- Specific --}}
@endsection

@section('navigation')
<x-navigation.admin />
@endsection

@section('main')
<header>
    <h1>Изменение модельки</h1>
</header>

<form method="POST"
      action="{{ route('base-models.update', ['id' => $baseModel->getId()]) }}"
>
    @csrf
    @method('PATCH')

    <x-forms.submit :placeholder=" 'Сохранить изменения' " />
</form>
@endsection
