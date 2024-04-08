@extends('layouts.main')

@section('title', 'Изменение доп услуги')

@section('styles')
{{-- Form --}}
<link href="/assets/css/form/common.css" rel="stylesheet" type="text/css">
<link href="/assets/css/form/text.css" rel="stylesheet" type="text/css">
<link href="/assets/css/form/file.css" rel="stylesheet" type="text/css">
<link href="/assets/css/form/fieldset.css" rel="stylesheet" type="text/css">
<link href="/assets/css/form/submit.css" rel="stylesheet" type="text/css">

{{-- For moving form to the center of the screen --}}
<link href="/assets/css/admin/additional-services/create.css" rel="stylesheet" type="text/css">

{{-- Specific --}}
<link href="/assets/css/admin/additional-services/update.css" rel="stylesheet" type="text/css">
@endsection

@section('navigation')
<x-navigation.admin />
@endsection

@section('main')
<header>
    <h1>Изменение дополнительной услуги</h1>
</header>

<form method="POST"
      enctype="multipart/form-data"
      action="{{ route('additional-services.update', ['id' => $additionalService->getId()]) }}"
>
    @csrf
    @method('PATCH')

    <fieldset>
        <legend>Общая информация</legend>
        <x-forms.inputs.text :name=" 'name' " :placeholder=" 'Название' " autofocus autocomplete="off" required value="{{ $additionalService->getName() }}" />
        <x-forms.inputs.text :name=" 'description' " :placeholder=" 'Описание' "  autocomplete="off" required value="{{ $additionalService->getDescription() }}" />
    </fieldset>

    <fieldset>
        <legend>Изображение предпросмотра</legend>
        <img src="{{ $additionalService->getPreviewImageUrl() }}">
        <x-forms.inputs.file :name=" 'previewImage' " accept="image/*" />
    </fieldset>

    <x-forms.submit :placeholder=" 'Сохранить' " />
</form>
@endsection
