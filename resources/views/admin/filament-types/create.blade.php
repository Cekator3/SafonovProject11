@extends('layouts.main')

@section('title', 'Создание типа филамента')

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
    <h1>Создание типа филамента</h1>
</header>

<form method="POST"
      action="{{ route('filament-types.create') }}"
>
    @csrf

    <fieldset>
        <legend>Общая информация</legend>
        <x-forms.inputs.text :name=" 'name' " :placeholder=" 'Название' " autocomplete="off" required />
        <x-forms.inputs.text :name=" 'description' " :placeholder=" 'Описание' "  autocomplete="off" required />
    </fieldset>

    <fieldset>
        <legend>Технологии 3д-печати, в которых может использоваться этот тип филамента</legend>

        @foreach ($printingTechnologies as $printingTechnology)
        <x-forms.inputs.checkbox-radio :name=" 'printing_technologies[]' "
                                       :placeholder=" $printingTechnology->getName() "
                                       :id=" $printingTechnology->getId() "
                                       value="{{ $printingTechnology->getId() }}"
        />
        @endforeach
    </fieldset>

    <fieldset class="filament-characteristics">
        <legend>Характеристики филамента</legend>
        <ul>
            <li class="filament-characteristic">
                <span class="name">Прочность</span>
                <x-forms.inputs.star-rate :name=" 'strength' " />
            </li>
            <li class="filament-characteristic">
                <span class="name">Жёсткость</span>
                <x-forms.inputs.star-rate :name=" 'hardness' " />
            </li>
            <li class="filament-characteristic">
                <span class="name">Ударостойкость</span>
                <x-forms.inputs.star-rate :name=" 'impact_resistance' " />
            </li>
            <li class="filament-characteristic">
                <span class="name">Износостойкость</span>
                <x-forms.inputs.star-rate :name=" 'durability' " />
            </li>
            <li class="filament-characteristic">
                <span class="name">Минимальная темпратура эксплуатации (в градусах)</span>
                <x-forms.inputs.text :name=" 'min_work_temperature' "
                                     :type=" 'number' "
                                     :placeholder=" '' "
                 />
            </li>
            <li class="filament-characteristic">
                <span class="name">Максимальная темпратура эксплуатации (в градусах)</span>
                <x-forms.inputs.text :name=" 'max_work_temperature' "
                                     :type=" 'number' "
                                     :placeholder=" '' "
                 />
            </li>
            <li class="filament-characteristic">
                <x-forms.inputs.checkbox-radio :name=" 'food_contact_allowed' "
                                               :placeholder=" 'Возможность контакта с пищей' "/>
            </li>
        </ul>
    </fieldset>

    <x-forms.submit :placeholder=" 'Сохранить' " />
</form>
@endsection
