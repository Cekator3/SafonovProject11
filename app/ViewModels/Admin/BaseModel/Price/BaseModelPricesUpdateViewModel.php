<?php

namespace App\ViewModels\Admin\BaseModel;

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
}
