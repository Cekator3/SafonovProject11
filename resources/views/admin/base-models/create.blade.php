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
<link href="/assets/css/admin/base-models/create.css" rel="stylesheet" type="text/css">
@endsection

@section('scripts')
<script src="/assets/js/admin/base-models/model-sizes.js" type="module" defer></script>
<script src="/assets/js/admin/base-models/forms.js" type="module" defer></script>
<script src="/assets/js/admin/base-models/init-form.js" type="module" defer></script>
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

    <fieldset>
        <legend>Общая информация</legend>
        <x-forms.inputs.text :name=" 'name' "
                             :placeholder=" 'Название' "
                             autofocus
                             autocomplete="off"
                             {{-- required --}}
        />
        <x-forms.inputs.text :name=" 'description' "
                             :placeholder=" 'Описание' "
                             autocomplete="off"
                             {{-- required --}}
        />
    </fieldset>

    <fieldset>
        <legend>Изображение предпросмотра</legend>
        <x-forms.inputs.file :name=" 'previewImage' " accept="image/*" />
    </fieldset>

    <fieldset>
        <legend>Множители размеров</legend>
        <ul class="model-sizes">
            <li>
                <div class="multiplier">
                    <x-forms.inputs.text :name=" 'model-sizes[][Multiplier]' "
                                         :type=" 'number' "
                                         :placeholder=" 'Множитель размера' "
                                         step='0.01'
                                         autocomplete="off"
                    />
                </div>
                <div class="actual-values">
                    <x-forms.inputs.text :name=" 'model-sizes[][length]' "
                                         :type=" 'number' "
                                         :placeholder=" 'Длина' "
                                         autocomplete="off"
                    />
                    <x-forms.inputs.text :name=" 'model-sizes[][width]' "
                                         :type=" 'number' "
                                         :placeholder=" 'Ширина' "
                                         autocomplete="off"
                    />
                    <x-forms.inputs.text :name=" 'model-sizes[][height]' "
                                         :type=" 'number' "
                                         :placeholder=" 'Высота' "
                                         autocomplete="off"
                    />
                </div>
                <button class="delete">X</button>
            </li>
            <li class="add"><button>+</button></li>
        </ul>
    </fieldset>

    <fieldset>
        <legend>Галерея товара</legend>
        <x-forms.inputs.file :name=" 'previewImage' " accept="image/*" multiple/>
    </fieldset>

    <x-forms.submit :placeholder=" 'Сохранить' " />
</form>
@endsection
