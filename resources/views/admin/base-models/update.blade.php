@extends('layouts.main')

@section('title', 'Изменение модельки')

@section('styles')
{{-- Form --}}

{{-- Specific --}}
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
    <h1>Изменение модельки</h1>
</header>

<form enctype="multipart/form-data"
      method="POST"
      action="{{ route('base-models.update', ['id' => $baseModel->getId()]) }}"
      id='model-form'
>
    @csrf
    @method('PATCH')

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
                    <x-forms.inputs.text :name=" 'model-sizes[][multiplier]' "
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

    <x-forms.submit :placeholder=" 'Сохранить изменения' " />
</form>
@endsection
