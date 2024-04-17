@extends('layouts.main')

@section('title', 'Добавление '.$model->getName().' в заказ')

@section('styles')
{{-- Form --}}
<link href="/assets/css/form/common.css" rel="stylesheet" type="text/css">
<link href="/assets/css/form/fieldset.css" rel="stylesheet" type="text/css">
<link href="/assets/css/form/checkbox-radio.css" rel="stylesheet" type="text/css">
<link href="/assets/css/form/submit.css" rel="stylesheet" type="text/css">

{{-- Specific --}}
<link href="/assets/css/admin/base-models/model-size-list.css" rel="stylesheet" type="text/css">
<link href="/assets/css/admin/base-models/create.css" rel="stylesheet" type="text/css">
@endsection

@section('navigation')
<x-navigation.customer />
@endsection

@section('main')
<header>
    <h1>Добавление {{ $model->getName() }} в заказ</h1>
</header>

<form method="POST"
      action="{{ route('shopping-cart.add.catalog-model', ['baseModelId' => $model->getId()]) }}"
>
    @csrf
    @method('PUT')

    <fieldset>
        <legend>Способ печати</legend>
        @foreach ($model->getPrintingTechnologies() as $printingTechnology)
            <div class="option">
                <x-forms.inputs.checkbox-radio :type=" 'radio' "
                                               :name=" 'printing-technology' "
                                               :placeholder=" $printingTechnology->getName() "
                                               :id=" 'printing-technology-'.$printingTechnology->getId() "
                                               value="{{ $printingTechnology->getId() }}"
                                               required
                />
                <span>{{ $printingTechnology->getPrice() }}</span>
            </div>
            <p>{{ $printingTechnology->getDescription() }}</p>
        @endforeach
    </fieldset>

    <fieldset>
        <legend>Размер</legend>
        @foreach ($model->getModelSizes() as $size)
            <div class="option">
                <x-forms.inputs.checkbox-radio :type=" 'radio' "
                                               :name=" 'model-size' "
                                               :placeholder=" $size->getMultiplier().'%' "
                                               :id=" 'model-size-'.$size->getId() "
                                               value="{{ $size->getId() }}"
                                               required
                />
                <span>{{ $size->getPrice() }}</span>
            </div>
            <p>{{ $size->getLength() . 'X' . $size->getWidth() . 'X' . $size->getHeight() . 'СМ' }}</p>
        @endforeach
    </fieldset>

    <fieldset>
        <legend>Филамент</legend>
        @foreach ($model->getFilamentTypes() as $filamentType)
            <div class="option">
                <x-forms.inputs.checkbox-radio :type=" 'radio' "
                                               :name=" 'filament-type' "
                                               :placeholder=" $filamentType->getName() "
                                               :id=" 'filament-type-'.$filamentType->getId() "
                                               value="{{ $filamentType->getId() }}"
                                               required
                />
                <span>{{ $filamentType->getPrice() }}</span>
            </div>
            <div>
                <span>Прочность</span>
                <span>{{ $filamentType->getStrength() }}</span>
            </div>
            <div>
                <span>Жёсткость</span>
                <span>{{ $filamentType->getHardness() }}</span>
            </div>
            <div>
                <span>Ударостойкость</span>
                <span>{{ $filamentType->getImpactResistance() }}</span>
            </div>
            <div>
                <span>Износостойкость</span>
                <span>{{ $filamentType->getDurability() }}</span>
            </div>
            <div>
                <span>Температура эксплуатации</span>
                <span>от {{ $filamentType->getMinWorkTemperature() }} до {{ $filamentType->getMaxWorkTemperature() }}</span>
            </div>
            <div>
                <span>Возможность контакта с пищей</span>
                <span>{{ $filamentType->isFoodContactAllowed() ? 'Да' : 'Нет' }}</span>
            </div>
            <p>{{ $filamentType->getDescription() }}</p>
        @endforeach
    </fieldset>

    <fieldset>
        <legend>Заполненность</legend>
        <div>
            <div class="option">
                <x-forms.inputs.checkbox-radio :type=" 'radio' "
                                               :name=" 'holedness' "
                                               :placeholder=" 'Целая' "
                                               :id=" 'holedness-solid' "
                                               value="solid"
                                               required
                />
                <span>{{ $model->getPriceForSolidType() }}</span>
            </div>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Repellat, commodi doloremque accusantium molestiae nobis perspiciatis beatae voluptatum laudantium earum ipsa voluptas at asperiores autem repudiandae ipsum aliquam voluptates magni vero?</p>
        </div>
        <div>
            <div class="option">
                <x-forms.inputs.checkbox-radio :type=" 'radio' "
                                               :name=" 'holedness' "
                                               :placeholder=" 'Полая' "
                                               :id=" 'holedness-holed' "
                                               value="holed"
                                               required
                />
                <span>{{ $model->getPriceForHoledType() }}</span>
            </div>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Repellat, commodi doloremque accusantium molestiae nobis perspiciatis beatae voluptatum laudantium earum ipsa voluptas at asperiores autem repudiandae ipsum aliquam voluptates magni vero?</p>
        </div>
    </fieldset>

    <fieldset>
        <legend>Разбираемость</legend>
        <div>
            <div class="option">
                <x-forms.inputs.checkbox-radio :type=" 'radio' "
                                               :name=" 'partedness' "
                                               :placeholder=" 'Обычная' "
                                               :id=" 'partedness-not-parted' "
                                               value="not-parted"
                                               required
                />
                <span>{{ $model->getPriceForNotPartedType() }}</span>
            </div>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Repellat, commodi doloremque accusantium molestiae nobis perspiciatis beatae voluptatum laudantium earum ipsa voluptas at asperiores autem repudiandae ipsum aliquam voluptates magni vero?</p>
        </div>
        <div>
            <div class="option">
                <x-forms.inputs.checkbox-radio :type=" 'radio' "
                                               :name=" 'partedness' "
                                               :placeholder=" 'Разбираемая' "
                                               :id=" 'partedness-parted' "
                                               value="parted"
                                               required
                />
                <span>{{ $model->getPriceForPartedType() }}</span>
            </div>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Repellat, commodi doloremque accusantium molestiae nobis perspiciatis beatae voluptatum laudantium earum ipsa voluptas at asperiores autem repudiandae ipsum aliquam voluptates magni vero?</p>
        </div>
    </fieldset>

    <fieldset>
        <legend>Цвет</legend>
        <div class="option">
            @foreach ($model->getColors() as $color)
                <div class="color">
                    <x-forms.inputs.checkbox-radio :type=" 'radio' "
                                                   :name=" 'color' "
                                                   :placeholder=" '' "
                                                   :id=" 'color-'.$color->getPrice() "
                                                   value="{{ $color->getId() }}"
                                                   required
                    />
                    <span style="background: {{ $color->getRgbCss() }}; height: 40px; width: 40px;"></span>
                </div>
                <span>{{ $color->getPrice() }}</span>
            @endforeach
        </div>
    </fieldset>

    <fieldset>
        <legend>Доп услуги</legend>
        <div class="option">
            @foreach ($model->getAdditionalServices() as $additionalService)
                <div class="color">
                    <x-forms.inputs.checkbox-radio :type=" 'radio' "
                                                   :name=" 'additional-services[]' "
                                                   :placeholder=" '' "
                                                   :id=" 'additional-service-'.$color->getPrice() "
                                                   value="{{ $additionalService->getId() }}"
                                                   required
                    />
                    <section>
                        <header><h3>{{ $additionalService->getName() }}</h3></header>
                        <img loading="lazy" src="{{ $additionalService->getPreviewImageUrl() }}" alt="">

                        <p>{{ $additionalService->getDescription() }}</p>
                    </section>
                </div>
                <span>{{ $color->getPrice() }}</span>
            @endforeach
        </div>
    </fieldset>

    <x-forms.submit :placeholder=" 'Добавить' " />
</form>
@endsection
