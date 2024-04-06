@extends('layouts.main')

@section('title', 'Добавление технологии 3д-печати')

@section('styles')
{{-- Form --}}
<link href="/assets/css/form/common.css" rel="stylesheet" type="text/css">
<link href="/assets/css/form/text.css" rel="stylesheet" type="text/css">
<link href="/assets/css/form/fieldset.css" rel="stylesheet" type="text/css">
<link href="/assets/css/form/submit.css" rel="stylesheet" type="text/css">

{{-- Specific --}}
<link href="/assets/css/admin/additional-services/create.css" rel="stylesheet" type="text/css">
@endsection

@section('navigation')
<x-navigation.admin />
@endsection

@section('main')
<header>
    <h1>Добавление технологии 3д-печати</h1>
</header>

<form method="POST" action="{{ route('printing-technologies.create') }}">
    @csrf
    <fieldset>
        <legend>Общая информация</legend>
        <x-forms.inputs.text :name=" 'name' " :placeholder=" 'Название' " autocomplete="off" required />
        <x-forms.inputs.text :name=" 'description' " :placeholder=" 'Описание' "  autocomplete="off" required/>
    </fieldset>
    <x-forms.submit :placeholder=" 'Сохранить' " />
</form>
@endsection
