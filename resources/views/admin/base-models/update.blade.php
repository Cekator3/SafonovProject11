@extends('layouts.main')

@section('title', 'Изменение модельки')

@section('styles')
{{-- Form --}}
<link href="/assets/css/form/common.css" rel="stylesheet" type="text/css">
<link href="/assets/css/form/text.css" rel="stylesheet" type="text/css">
<link href="/assets/css/form/file.css" rel="stylesheet" type="text/css">
<link href="/assets/css/form/fieldset.css" rel="stylesheet" type="text/css">
<link href="/assets/css/form/submit.css" rel="stylesheet" type="text/css">
<link href="/assets/css/links/link-button.css" rel="stylesheet" type="text/css">

{{-- Specific --}}
<link href="/assets/css/admin/base-models/model-size-list.css" rel="stylesheet" type="text/css">
<link href="/assets/css/admin/base-models/update.css" rel="stylesheet" type="text/css">
@endsection

@section('scripts')
{{-- Model sizes --}}
<script defer src="/assets/js/admin/base-models/model-sizes/model-sizes.js" type="module"></script>
<script defer src="/assets/js/admin/base-models/model-sizes/init-model-sizes.js" type="module"></script>

{{-- Model's gallery images --}}
<script defer src="/assets/js/admin/base-models/gallery-images/gallery-images.js" type="module"></script>
<script defer src="/assets/js/forms/form-inputs.js" type="module"></script>
<script defer src="/assets/js/admin/base-models/gallery-images/init-model-gallery.js" type="module"></script>

{{-- Specific --}}
<script defer src="/assets/js/forms/form-inputs-names.js" type="module"></script>
<script defer src="/assets/js/admin/base-models/base-model-update.js" type="module"></script>
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
                             :value=" old('name') ?? $model->getName() "
                             autofocus
                             autocomplete="off"
                             required
        />
        <x-forms.inputs.text :name=" 'description' "
                             :placeholder=" 'Описание' "
                             :value=" old('description') ?? $model->getDescription() "
                             autocomplete="off"
                             required
        />
    </fieldset>

    <div class="preview-and-price-change">
        <fieldset class="preview-image">
            <legend>Изображение предпросмотра</legend>
            <img src="{{ $model->getPreviewImageUrl() }}" alt="" loading="lazy">
            <x-forms.inputs.file :name=" 'previewImage' " accept="image/*"/>
        </fieldset>

        <fieldset class="price-change">
            <legend>Стоимость печати</legend>
            <a class="link button" href="{{ route('base-models.update-prices', ['id' => $model->getId()]) }}">Изменить</a>
        </fieldset>

    </div>

    <fieldset>
        <legend>Множители размеров</legend>
        <ul class="model-sizes">
            @if (empty(old('model-sizes')))
            @foreach ($model->getSizes() as $size)
            <li>
                <x-admin.base-models.size :index="$loop->index"
                                          :multiplier="$size->getMultiplier()"
                                          :length="$size->getLength()"
                                          :width="$size->getWidth()"
                                          :height="$size->getHeight()"
                />
            </li>
            @endforeach
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
        <x-forms.inputs.file :name=" 'galleryImages[]' " accept="image/*" multiple/>
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
