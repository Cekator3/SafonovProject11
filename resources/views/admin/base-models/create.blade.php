@extends('layouts.main')

@section('title', 'Создание модельки')

@section('styles')
{{-- Form --}}
<link href="/assets/css/form/common.css" rel="stylesheet" type="text/css">
<link href="/assets/css/form/text.css" rel="stylesheet" type="text/css">
<link href="/assets/css/form/file.css" rel="stylesheet" type="text/css">
<link href="/assets/css/form/fieldset.css" rel="stylesheet" type="text/css">
<link href="/assets/css/form/submit.css" rel="stylesheet" type="text/css">

{{-- Specific --}}
<link href="/assets/css/admin/base-models/model-size-list.css" rel="stylesheet" type="text/css">
<link href="/assets/css/admin/base-models/create.css" rel="stylesheet" type="text/css">
@endsection

@section('scripts')
{{-- Model sizes --}}
<script defer src="/assets/js/admin/base-models/model-sizes/model-sizes.js" type="module"></script>
<script defer src="/assets/js/admin/base-models/model-sizes/init-model-sizes.js" type="module"></script>

{{-- Specific --}}
<script defer src="/assets/js/forms/form-inputs-names.js" type="module"></script>
<script defer src="/assets/js/admin/base-models/base-model-create.js" type="module"></script>
@endsection

@section('navigation')
<x-navigation.admin />
@endsection

@section('main')
<header>
    <h1>Создание модельки</h1>
</header>

<form enctype="multipart/form-data"
      method="POST"
      action="{{ route('base-models.create') }}"
      id="model-form"
>
    @csrf

    <fieldset>
        <legend>Общая информация</legend>
        <x-forms.inputs.text :name=" 'name' "
                             :placeholder=" 'Название' "
                             autofocus
                             autocomplete="off"
                             required
        />
        <x-forms.inputs.text :name=" 'description' "
                             :placeholder=" 'Описание' "
                             autocomplete="off"
                             required
        />
    </fieldset>

    <fieldset>
        <legend>Изображение предпросмотра</legend>
        <x-forms.inputs.file :name=" 'previewImage' " accept="image/*" required />
    </fieldset>

    <fieldset>
        <legend>Множители размеров</legend>
        <ul class="model-sizes">
            @if (empty(old('model-sizes')))
            <li>
                <x-admin.base-models.size />
            </li>
            @else
            @foreach (old('model-sizes') as $size)
            <li>
                <x-admin.base-models.size :index="$loop->index"
                                          :multiplier="$size['multiplier']"
                                          :length="$size['length']"
                                          :width="$size['width']"
                                          :height="$size['height']"
                />
            </li>
            @endforeach
            @endif
            <li class="add"><button>+</button></li>
        </ul>
    </fieldset>

    <fieldset>
        <legend>Галерея товара</legend>
        <x-forms.inputs.file :name=" 'galleryImages[]' " accept="image/*" multiple required/>
    </fieldset>

    <x-forms.submit :placeholder=" 'Сохранить' " />
</form>
@endsection
