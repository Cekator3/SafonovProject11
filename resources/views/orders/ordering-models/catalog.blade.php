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

    <fieldset class="printing-technologies">
        <legend>Способ печати</legend>
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Obcaecati quis molestias eveniet natus ipsum ullam nihil porro, ipsam, possimus magnam eos autem consequuntur cum quia quos magni reprehenderit facilis sunt.</p>
        <ul>
        @foreach ($model->getPrintingTechnologies() as $printingTechnology)
            <li class="option">
                <div class="description">
                    <x-forms.inputs.checkbox-radio :type=" 'radio' "
                                                    :name=" 'printing-technology' "
                                                    :placeholder=" $printingTechnology->getName() "
                                                    :id=" 'printing-technology-'.$printingTechnology->getId() "
                                                    value="{{ $printingTechnology->getId() }}"
                                                    required
                    />
                    <p>{{ $printingTechnology->getDescription() }}</p>
                </div>
                <div class="price">{{ $printingTechnology->getPrice() }}</div>
            </li>
        @endforeach
        </ul>
    </fieldset>

    <fieldset class="model-sizes">
        <legend>Размер</legend>
        <ul>
        @foreach ($model->getModelSizes() as $size)
            <li class="option">
                <div class="description">
                    <x-forms.inputs.checkbox-radio :type=" 'radio' "
                                                :name=" 'model-size' "
                                                :placeholder=" $size->getMultiplier().'%' "
                                                :id=" 'model-size-'.$size->getId() "
                                                value="{{ $size->getId() }}"
                                                required
                    />
                    <p>{{ $size->getLength() . 'X' . $size->getWidth() . 'X' . $size->getHeight() . 'СМ' }}</p>
                </div>
                <div class="price">{{ $size->getPrice() }}</div>
            </li>
        @endforeach
        </ul>
    </fieldset>

    <fieldset class="filament-type">
        <legend>Тип филамента</legend>
        <ul>
        @foreach ($model->getFilamentTypes() as $filamentType)
            <li class="option">
                <div class="description">
                    <x-forms.inputs.checkbox-radio :type=" 'radio' "
                                                :name=" 'filament-type' "
                                                :placeholder=" $filamentType->getName() "
                                                :id=" 'filament-type-'.$filamentType->getId() "
                                                value="{{ $filamentType->getId() }}"
                                                required
                    />
                    <p>{{ $filamentType->getDescription() }}</p>
                </div>
                <div class="price">{{ $filamentType->getPrice() }}</div>
                <ul class="characteristics">
                    <li>
                        <span>Прочность</span>
                        <span>{{ $filamentType->getStrength() }}</span>
                    </li>

                    <li>
                        <span>Жёсткость</span>
                        <span>{{ $filamentType->getHardness() }}</span>
                    </li>

                    <li>
                        <span>Ударостойкость</span>
                        <span>{{ $filamentType->getImpactResistance() }}</span>
                    </li>

                    <li>
                        <span>Износостойкость</span>
                        <span>{{ $filamentType->getDurability() }}</span>
                    </li>

                    <li>
                        <span>Температура эксплуатации</span>
                        <span>от {{ $filamentType->getMinWorkTemperature() }} до {{ $filamentType->getMaxWorkTemperature() }}</span>
                    </li>

                    <li>
                        <span>Возможность контакта с пищей</span>
                        <span>{{ $filamentType->isFoodContactAllowed() ? 'Да' : 'Нет' }}</span>
                    </li>
                </ul>
            </li>
        @endforeach
        </ul>
    </fieldset>

    <fieldset class="holedness">
        <legend>Заполненность</legend>
        <ul>
            <li class="option">
                <div class="description">
                    <x-forms.inputs.checkbox-radio :type=" 'radio' "
                                                :name=" 'holedness' "
                                                :placeholder=" 'Целая' "
                                                :id=" 'holedness-solid' "
                                                value="solid"
                                                required
                    />
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Repellat, commodi doloremque accusantium molestiae nobis perspiciatis beatae voluptatum laudantium earum ipsa voluptas at asperiores autem repudiandae ipsum aliquam voluptates magni vero?</p>
                </div>
                <div class="price">{{ $model->getPriceForSolidType() }}</div>
            </li>
            <li class="option">
                <div class="description">
                    <x-forms.inputs.checkbox-radio :type=" 'radio' "
                                                :name=" 'holedness' "
                                                :placeholder=" 'Полая' "
                                                :id=" 'holedness-holed' "
                                                value="holed"
                                                required
                    />
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Repellat, commodi doloremque accusantium molestiae nobis perspiciatis beatae voluptatum laudantium earum ipsa voluptas at asperiores autem repudiandae ipsum aliquam voluptates magni vero?</p>
                </div>
                <div class="price">{{ $model->getPriceForHoledType() }}</div>
            </li>
        </ul>
    </fieldset>

    <fieldset class="partedness">
        <legend>Разбираемость</legend>
        <ul>
            <li class="option">
                <div class="description">
                    <x-forms.inputs.checkbox-radio :type=" 'radio' "
                                                :name=" 'partedness' "
                                                :placeholder=" 'Обычная' "
                                                :id=" 'partedness-not-parted' "
                                                value="not-parted"
                                                required
                    />
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Repellat, commodi doloremque accusantium molestiae nobis perspiciatis beatae voluptatum laudantium earum ipsa voluptas at asperiores autem repudiandae ipsum aliquam voluptates magni vero?</p>
                </div>
                <div class="price">{{ $model->getPriceForNotPartedType() }}</div>
            </li>

            <li class="option">
                <div class="description">
                    <x-forms.inputs.checkbox-radio :type=" 'radio' "
                                                :name=" 'partedness' "
                                                :placeholder=" 'Разбираемая' "
                                                :id=" 'partedness-parted' "
                                                value="parted"
                                                required
                    />
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Repellat, commodi doloremque accusantium molestiae nobis perspiciatis beatae voluptatum laudantium earum ipsa voluptas at asperiores autem repudiandae ipsum aliquam voluptates magni vero?</p>
                </div>
                <div class="price">{{ $model->getPriceForPartedType() }}</div>
            </li>
        </ul>
    </fieldset>

    <fieldset class="colors">
        <legend>Цвет</legend>
        <ul>
        @foreach ($model->getColors() as $color)
            <li class="option">
                <div class="description">
                    <x-forms.inputs.checkbox-radio :type=" 'radio' "
                                                    :name=" 'color' "
                                                    :placeholder=" '' "
                                                    :id=" 'color-'.$color->getPrice() "
                                                    value="{{ $color->getId() }}"
                                                    required
                    />
                    <span style="background: {{ $color->getRgbCss() }}; height: 40px; width: 40px;"></span>
                </div>
                <div class="price">{{ $color->getPrice() }}</div>
            </li>
        @endforeach
        </ul>
    </fieldset>

    <fieldset class="additional-services">
        <legend>Доп услуги</legend>
        <ul>
        @foreach ($model->getAdditionalServices() as $additionalService)
            <li class="option">
                <div class="description">
                    <x-forms.inputs.checkbox-radio :type=" 'radio' "
                                                   :name=" 'additional-services[]' "
                                                   :placeholder=" $additionalService->getName() "
                                                   :id=" 'additional-service-'.$color->getPrice() "
                                                   value="{{ $additionalService->getId() }}"
                                                   required
                    />
                    <figure>
                        <img loading="lazy" src="{{ $additionalService->getPreviewImageUrl() }}" alt="">
                        <figcaption>{{ $additionalService->getDescription() }}</figcaption>
                    </figure>
                </div>
                <div class="price">{{ $color->getPrice() }}</div>
            </li>
        @endforeach
        </ul>
    </fieldset>

    <x-forms.submit :placeholder=" 'Добавить' " />
</form>
@endsection
