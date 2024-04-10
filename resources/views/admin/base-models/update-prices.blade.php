@extends('layouts.main')

@section('title', 'Изменение стоимости модельки')

@section('styles')
{{-- Form --}}

{{-- Specific --}}
@endsection

@section('scripts')
@endsection

@section('navigation')
<x-navigation.admin />
@endsection

@section('main')
<header>
    <h1>Изменение стоимости модельки</h1>
</header>

<form method="POST"
      action="{{ route('base-models.update-prices', ['id' => $model->getId()]) }}"
>
    @csrf
    @method('PATCH')

    <x-forms.submit :placeholder=" 'Сохранить изменения' " />
</form>
@endsection
