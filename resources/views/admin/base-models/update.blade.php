@extends('layouts.main')

@section('title', 'Изменение модельки')

@section('styles')
{{-- Form --}}
<link href="/assets/css/form/common.css" rel="stylesheet" type="text/css">
<link href="/assets/css/form/text.css" rel="stylesheet" type="text/css">
<link href="/assets/css/form/file.css" rel="stylesheet" type="text/css">
<link href="/assets/css/form/fieldset.css" rel="stylesheet" type="text/css">
<link href="/assets/css/form/submit.css" rel="stylesheet" type="text/css">

{{-- Specific --}}
<link href="/assets/css/admin/base-models/model-size-list.css" rel="stylesheet" type="text/css">
<link href="/assets/css/admin/base-models/update.css" rel="stylesheet" type="text/css">
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
      action="{{ route('base-models.update', ['id' => $model->getId()]) }}"
      id='model-form'
>
    @csrf
    @method('PATCH')

    <fieldset>
        <legend>Общая информация</legend>
        <x-forms.inputs.text :name=" 'name' "
                             :placeholder=" 'Название' "
                             :value=" $model->getName() "
                             autofocus
                             autocomplete="off"
                             required
        />
        <x-forms.inputs.text :name=" 'description' "
                             :placeholder=" 'Описание' "
                             :value=" $model->getDescription() "
                             autocomplete="off"
                             required
        />
    </fieldset>

    <fieldset class="preview-image">
        <legend>Изображение предпросмотра</legend>
        <img src="{{ $model->getPreviewImageUrl() }}" alt="" loading="lazy">
        <x-forms.inputs.file :name=" 'previewImage' " accept="image/*"/>
    </fieldset>

    <fieldset>
        <legend>Множители размеров</legend>
        <ul class="model-sizes">
            @foreach ($model->getSizes() as $size)
            <li>
                <div class="multiplier">
                    <x-forms.inputs.text :name=" 'model-sizes[][multiplier]' "
                                         :type=" 'number' "
                                         :placeholder=" 'Множитель размера' "
                                         :value=" $size->getMultiplier() "
                                         step='0.01'
                                         autocomplete="off"
                                         required
                    />
                </div>
                <div class="actual-values">
                    <x-forms.inputs.text :name=" 'model-sizes[][length]' "
                                         :type=" 'number' "
                                         :placeholder=" 'Длина' "
                                         :value=" $size->getLength() "
                                         autocomplete="off"
                                         required
                    />
                    <x-forms.inputs.text :name=" 'model-sizes[][width]' "
                                         :type=" 'number' "
                                         :placeholder=" 'Ширина' "
                                         :value=" $size->getWidth() "
                                         autocomplete="off"
                                         required
                    />
                    <x-forms.inputs.text :name=" 'model-sizes[][height]' "
                                         :type=" 'number' "
                                         :placeholder=" 'Высота' "
                                         :value=" $size->getHeight() "
                                         autocomplete="off"
                                         required
                    />
                </div>
                <button class="delete">X</button>
            </li>
            @endforeach
            <li class="add"><button>+</button></li>
        </ul>
    </fieldset>

    <fieldset>
        <legend>Галерея товара</legend>
        <x-forms.inputs.file :name=" 'previewImage' " accept="image/*" multiple/>
        <ul class="gallery-images">
            @foreach ($model->getGalleryImages() as $galleryImage)
                <li id="gallery_image_{{ $galleryImage->getId() }}">
                    <img src="{{ $galleryImage->getUrl() }}" alt="" loading="lazy">

                    <x-forms.submit :placeholder=" 'Удалить' " />
                </li>
            @endforeach
        </ul>
    </fieldset>

    <x-forms.submit :placeholder=" 'Сохранить изменения' " />
</form>
@endsection
