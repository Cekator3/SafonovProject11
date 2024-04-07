@extends('layouts.main')

@section('title', 'Изменение типа филамента')

@section('styles')
{{-- Form --}}
<link href="/assets/css/form/common.css" rel="stylesheet" type="text/css">
<link href="/assets/css/form/checkbox-radio.css" rel="stylesheet" type="text/css">
<link href="/assets/css/common/star-rate.css" rel="stylesheet" type="text/css">
<link href="/assets/css/form/text.css" rel="stylesheet" type="text/css">
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

        @foreach ($filamentType->getPrintingTechnologies() as $printingTechnology)
        <x-forms.inputs.checkbox-radio :name=" 'printingTechnologies[]' "
                                       :placeholder=" $printingTechnology->getName() "
                                       :id=" $printingTechnology->getId() "
                                       value="{{ $printingTechnology->getId() }}"
        />
        @endforeach
    </fieldset>

    <fieldset>
        <legend>Характеристики филамента</legend>
        <ul>
            <li>
                <div class="filament-characteristic">
                    <span class="name">Прочность</span>
                    <x-forms.inputs.star-rate name=" 'strength' " />
                </div>
            </li>
        </ul>
    </fieldset>

    <x-forms.submit :placeholder=" 'Сохранить' " />
</form>
@endsection
