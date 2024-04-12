@extends('layouts.main')

@section('title', 'Изменение стоимости модельки')

@section('styles')
{{-- Form --}}
<link href="/assets/css/form/common.css" rel="stylesheet" type="text/css">
<link href="/assets/css/form/text.css" rel="stylesheet" type="text/css">
<link href="/assets/css/form/fieldset.css" rel="stylesheet" type="text/css">
<link href="/assets/css/form/submit.css" rel="stylesheet" type="text/css">

{{-- Specific --}}
<link href="/assets/css/admin/base-models/update-prices.css" rel="stylesheet" type="text/css">
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
      id="model-form"
>
    @csrf
    @method('PATCH')

    <fieldset class="prices printing-technologies">
        <legend>Стоимость технологий печати</legend>
        <ul>
        @foreach ($model->getPrintingTechnologies() as $printingTechnology)
            <li>
                <h3>{{ $printingTechnology->getName() }}</h3>
                <p>{{ $printingTechnology->getDescription() }}</p>
                <input type="hidden" name="prices[printing-technologies][{{ $printingTechnology->getId() }}][id]" value="{{ $printingTechnology->getId() }}">
                <x-forms.inputs.text :type=" 'number' "
                                     :name=" 'prices[printing-technologies]['.$printingTechnology->getId().'][price]' "
                                     :placeholder=" 'Цена' "
                                     :value=" old('prices.printing-technologies.'.$printingTechnology->getId().'.price') ?? $printingTechnology->getPrice() "
                                     step="0.01"
                                     required
                                     autocomplete="off"
                />
            </li>
        @endforeach
        </ul>
    </fieldset>

    <fieldset>
        <legend>Типы филаментов</legend>
        <ul>
        @foreach ($model->getFilamentTypes() as $filamentType)
            <li>
                <h3>{{ $filamentType->getName() }}</h3>
                <p>{{ $filamentType->getDescription() }}</p>
                <input type="hidden" name="prices[filament-types][{{ $filamentType->getId() }}][id]" value="{{ $filamentType->getId() }}">
                <x-forms.inputs.text :type=" 'number' "
                                     :name=" 'prices[filament-types]['.$filamentType->getId().'][price]' "
                                     :placeholder=" 'Цена' "
                                     :value=" old('prices.filament-types.'.$filamentType->getId().'.price') ?? $filamentType->getPrice()"
                                     step="0.01"
                                     required
                                     autocomplete="off"
                />
            </li>
        @endforeach
        </ul>
    </fieldset>

    <fieldset class="colors">
        <legend>Цвета</legend>
        <p>Цвета, у которых не указана цена не будут использоваться</p>
        <ul>
        @foreach ($model->getColors() as $color)
            <li>
                <span style="background: {{ $color->getRgbCss() }}"></span>
                <input type="hidden" name="prices[colors][{{ $color->getId() }}][id]" value="{{ $color->getId() }}">
                <x-forms.inputs.text :type=" 'number' "
                                     :name=" 'prices[colors]['. $color->getId() . '][price]' "
                                     :placeholder=" 'Цена' "
                                     :value=" old('prices.colors.'.$color->getId().'.price') ?? $color->getPrice()"
                                     step="0.01"
                                     autocomplete="off"
                />
            </li>
        @endforeach
        </ul>
    </fieldset>

    <fieldset>
        <legend>Размеры модельки</legend>
        <ul>
        @foreach ($model->getSizes() as $size)
            <li>
                <h3>
                    <span>{{ $size->getMultiplier() }}%</span>
                    <span>(</span>
                    <span>{{ $size->getLength() }}mm</span>
                    <span>x</span>
                    <span>{{ $size->getWidth() }}mm</span>
                    <span>x</span>
                    <span>{{ $size->getHeight() }}mm</span>
                    <span>)</span>
                </h3>
                <input type="hidden" name="prices[model-sizes][{{ $size->getId() }}][id]" value="{{ $size->getId() }}">
                <x-forms.inputs.text :type=" 'number' "
                                    :name=" 'prices[model-sizes]['.$size->getId().'][price]' "
                                    :placeholder=" 'Цена' "
                                    :value=" old('prices.model-sizes.'.$size->getId().'.price') ?? $size->getPrice()"
                                    step="0.01"
                                    autocomplete="off"
                                    required
                />
            </li>
        @endforeach
        </ul>
    </fieldset>

    <fieldset class="additional-services">
        <legend>Дополнительные услуги</legend>

        <ul>
        @foreach ($model->getAdditionalServices() as $service)
            <li>
                <h3>{{ $service->getName() }}</h3>
                <p>{{ $service->getDescription() }}</p>
                <img src="{{ $service->getPreviewImageUrl() }}" alt="">

                <input type="hidden" name="prices[additional-services][{{ $service->getId() }}][id]" value="{{ $service->getId() }}">
                <x-forms.inputs.text :type=" 'number' "
                                     :name=" 'prices[additional-services]['.$service->getId().'][price]' "
                                     :placeholder=" 'Цена' "
                                     :value=" old('prices.additional-services.'.$service->getId().'.price') ?? $service->getPrice() "
                                     step="0.01"
                                     required
                                     autocomplete="off"
                />
            </li>
        @endforeach
        </ul>
    </fieldset>

    <fieldset>
        <legend>Заполненность модельки</legend>
        <ul>
            <li>
                <h3>Заполненная</h3>
                <x-forms.inputs.text :type=" 'number' "
                                    :name=" 'prices[solid]' "
                                    :placeholder=" 'Цена' "
                                    :value=" old('prices.solid') ?? $model->getPriceForSolidType()"
                                    step="0.01"
                                    autocomplete="off"
                                    required
                />
            </li>
            <li>
                <h3>Полая</h3>
                <x-forms.inputs.text :type=" 'number' "
                                    :name=" 'prices[holed]' "
                                    :placeholder=" 'Цена' "
                                    :value=" old('prices.holed') ?? $model->getPriceForHoledType()"
                                    step="0.01"
                                    autocomplete="off"
                                    required
                />
            </li>
        </ul>
    </fieldset>

    <fieldset>
        <legend>Разбираемость модельки</legend>
        <ul>
            <li>
                <h3>Разбираемая</h3>
                <x-forms.inputs.text :type=" 'number' "
                                    :name=" 'prices[parted]' "
                                    :placeholder=" 'Цена' "
                                    :value=" old('prices.parted') ?? $model->getPriceForPartedType()"
                                    step="0.01"
                                    autocomplete="off"
                                    required
                />
            </li>
            <li>
                <h3>Неразбираемая</h3>
                <x-forms.inputs.text :type=" 'number' "
                                    :name=" 'prices[not-parted]' "
                                    :placeholder=" 'Цена' "
                                    :value=" old('prices.not-parted') ?? $model->getPriceForNotPartedType()"
                                    step="0.01"
                                    autocomplete="off"
                                    required
                />
            </li>
        </ul>
    </fieldset>

    <x-forms.submit :placeholder=" 'Сохранить изменения' " />
</form>
@endsection
