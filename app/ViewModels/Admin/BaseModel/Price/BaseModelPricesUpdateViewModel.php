<?php

namespace App\ViewModels\Admin\BaseModel\Price;

use App\ViewModels\Admin\BaseModel\Price\ColorPrice;
use App\ViewModels\Admin\BaseModel\Price\FilamentTypePrice;
use App\ViewModels\Admin\BaseModel\Price\BaseModelSizePrice;
use App\ViewModels\Admin\BaseModel\Price\PrintingTechnologyPrice;

/**
 * class for transferring input
 * that was entered in an base model price update form
 * from interfaces (views)
 * to the application (services and repositories).
 */
class BaseModelPricesUpdateViewModel
{
    public int $id;

    /**
     * @var AdditionalServicePrice[]
     */
    public array $additionalServicesPrices;

    /**
     * @var PrintingTechnologyPrice[]
     */
    public array $printingTechnologiesPrices;

    /**
     * @var FilamentTypePrice[]
     */
    public array $filamentTypesPrices;

    /**
     * @var ColorPrice[]
     */
    public array $colorsPrices;

    /**
     * @var BaseModelSizePrice[]
     */
    public array $modelSizesPrices;

    public float $priceForSolidType;
    public float $priceForHoledType;
    public float $priceForPartedType;
    public float $priceForNotPartedType;

    /**
     * @var string $priceForSolidTypeInputName the name of the input.
     * It will be used to add errors to the input.
     */
    public string $priceForSolidTypeInputName;
    public string $priceForHoledTypeInputName;
    public string $priceForPartedTypeInputName;
    public string $priceForNotPartedTypeInputName;
}
