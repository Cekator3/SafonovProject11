@extends('layouts.main')

@section('title', 'Изменение типа филамента')

@section('styles')
{{-- Form --}}
<link href="/assets/css/form/common.css" rel="stylesheet" type="text/css">
<link href="/assets/css/form/checkbox-radio.css" rel="stylesheet" type="text/css">
<link href="/assets/css/form/star-rate.css" rel="stylesheet" type="text/css">
<link href="/assets/css/form/text.css" rel="stylesheet" type="text/css">
<link href="/assets/css/form/fieldset.css" rel="stylesheet" type="text/css">
<link href="/assets/css/form/submit.css" rel="stylesheet" type="text/css">

{{-- For moving form to the center of the screen --}}
<link href="/assets/css/admin/additional-services/create.css" rel="stylesheet" type="text/css">

{{-- Specific --}}
<link href="/assets/css/admin/filament-types/edit.css" rel="stylesheet" type="text/css">
@endsection

@section('navigation')
<x-navigation.admin />
@endsection

@section('main')
<header>
    <h1>Изменение типа филамента</h1>
</header>

<form method="POST"
      action="{{ route('filament-types.update', ['id' => $filamentType->getId()]) }}"
>
    @csrf
    @method('PATCH')

    <fieldset>
        <legend>Общая информация</legend>
        <x-forms.inputs.text :name=" 'name' " :placeholder=" 'Название' " autocomplete="off" required value="{{ $filamentType->getName() }}" />
        <x-forms.inputs.text :name=" 'description' " :placeholder=" 'Описание' "  autocomplete="off" required value="{{ $filamentType->getDescription() }}" />
    </fieldset>

    <fieldset>
        <legend>Технологии 3д-печати, в которых может использоваться этот тип филамента</legend>

        @foreach ($printingTechnologies as $printingTechnology)
        <x-forms.inputs.checkbox-radio :name=" 'printing_technologies[]' "
                                       :placeholder=" $printingTechnology->getName() "
                                       :id=" $printingTechnology->getId() "
                                       :checked=" $filamentType->isUsedInPrintingTechnology($printingTechnology->getId()) "
                                       value="{{ $printingTechnology->getId() }}"
        />
        @endforeach
    </fieldset>

    <fieldset class="filament-characteristics">
        <legend>Характеристики филамента</legend>
        <ul>
            <li class="filament-characteristic">
                <span class="name">Прочность</span>
                <x-forms.inputs.star-rate :name=" 'strength' "
                                          :value=" $filamentType->getStrength() "
                />
            </li>

            <li class="filament-characteristic">
                <span class="name">Жёсткость</span>
                <x-forms.inputs.star-rate :name=" 'hardness' "
                                          :value=" $filamentType->getHardness() "
                />
            </li>

            <li class="filament-characteristic">
                <span class="name">Ударостойкость</span>
                <x-forms.inputs.star-rate :name=" 'impact_resistance' "
                                          :value=" $filamentType->getImpactResistance() "
                />
            </li>

            <li class="filament-characteristic">
                <span class="name">Износостойкость</span>
                <x-forms.inputs.star-rate :name=" 'durability' "
                                          :value=" $filamentType->getDurability() "
                />
            </li>

            <li class="filament-characteristic">
                <span class="name">Минимальная темпратура эксплуатации (в градусах)</span>
                <x-forms.inputs.text :name=" 'min_work_temperature' "
                                     :type=" 'number' "
                                     :placeholder=" '' "
                                     :value=" $filamentType->getMinWorkTemperature() "
                 />
            </li>

            <li class="filament-characteristic">
                <span class="name">Максимальная темпратура эксплуатации (в градусах)</span>
                <x-forms.inputs.text :name=" 'max_work_temperature' "
                                     :type=" 'number' "
                                     :placeholder=" '' "
                                     :value=" $filamentType->getMaxWorkTemperature() "
                 />
            </li>

            <li class="filament-characteristic">
                <x-forms.inputs.checkbox-radio :name=" 'food_contact_allowed' "
                                               :placeholder=" 'Возможность контакта с пищей' "
                                               :checked=" $filamentType->isFoodContactAllowed() "
                />
            </li>
        </ul>
    </fieldset>

    <x-forms.submit :placeholder=" 'Сохранить' " />
</form>
@endsection
