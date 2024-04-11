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
        @php
            $counter = 0;
        @endphp
        @foreach ($model->getPrintingTechnologies() as $printingTechnology)
            <li>
                <h3>{{ $printingTechnology->getName() }}</h3>
                <p>{{ $printingTechnology->getDescription() }}</p>
                <input type="hidden" name="prices[printing-technologies][{{ $counter }}][id]" value="{{ $printingTechnology->getId() }}">
                <x-forms.inputs.text :type=" 'number' "
                                    :name=" 'prices[printing-technologies]['. $counter . '][price]' "
                                    :placeholder=" 'Цена' "
                                    :value=" $printingTechnology->getPrice() "
                                    step="0.01"
                                    required
                                    autocomplete="off"
                />
            </li>
            @php
                $counter++;
            @endphp
        @endforeach
        </ul>
    </fieldset>

    <fieldset>
        <legend>Типы филаментов</legend>
        <ul>
        @php
            $counter = 0;
        @endphp
        @foreach ($model->getFilamentTypes() as $filamentType)
            <li>
                <h3>{{ $filamentType->getName() }}</h3>
                <p>{{ $filamentType->getDescription() }}</p>
                <input type="hidden" name="prices[filament-types][{{ $counter }}][id]" value="{{ $filamentType->getId() }}">
                <x-forms.inputs.text :type=" 'number' "
                                    :name=" 'prices[filament-types]['. $counter . '][price]' "
                                    :placeholder=" 'Цена' "
                                    :value=" $filamentType->getPrice()"
                                    step="0.01"
                                    required
                                    autocomplete="off"
                />
            </li>
        @php
            $counter++;
        @endphp
        @endforeach
        </ul>
    </fieldset>

    <fieldset class="colors">
        <legend>Цвета</legend>
        <p>Цвета, у которых не высставлена цена не будут использоваться</p>
        <ul>
        @php
            $counter = 0;
        @endphp
        @foreach ($model->getColors() as $color)
            <li>
                <span style="background: {{ $color->getRgbCss() }}"></span>
                <input type="hidden" name="prices[colors][{{ $counter }}][id]" value="{{ $color->getId() }}">
                <x-forms.inputs.text :type=" 'number' "
                                    :name=" 'prices[colors]['. $counter . '][price]' "
                                    :placeholder=" 'Цена' "
                                    :value=" $color->getPrice()"
                                    step="0.01"
                                    autocomplete="off"
                />
            </li>
        @php
            $counter++;
        @endphp
        @endforeach
        </ul>
    </fieldset>

    <fieldset>
        <legend>Размеры модельки</legend>
        <ul>
        @php
            $counter = 0;
        @endphp
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
                <input type="hidden" name="prices[model-sizes][{{ $counter }}][id]" value="{{ $size->getId() }}">
                <x-forms.inputs.text :type=" 'number' "
                                    :name=" 'prices[model-sizes]['. $counter . '][price]' "
                                    :placeholder=" 'Цена' "
                                    :value=" $size->getPrice()"
                                    step="0.01"
                                    autocomplete="off"
                />
            </li>
        @php
            $counter++;
        @endphp
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
                                    :value=" $model->getPriceForSolidType()"
                                    step="0.01"
                                    autocomplete="off"
                />
            </li>
            <li>
                <h3>Полая</h3>
                <x-forms.inputs.text :type=" 'number' "
                                    :name=" 'prices[holed]' "
                                    :placeholder=" 'Цена' "
                                    :value=" $model->getPriceForHoledType()"
                                    step="0.01"
                                    autocomplete="off"
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
                                    :value=" $model->getPriceForPartedType()"
                                    step="0.01"
                                    autocomplete="off"
                />
            </li>
            <li>
                <h3>Неразбираемая</h3>
                <x-forms.inputs.text :type=" 'number' "
                                    :name=" 'prices[not-parted]' "
                                    :placeholder=" 'Цена' "
                                    :value=" $model->getPriceForNotPartedType()"
                                    step="0.01"
                                    autocomplete="off"
                />
            </li>
        </ul>
    </fieldset>

    <x-forms.submit :placeholder=" 'Сохранить изменения' " />
</form>
@endsection
