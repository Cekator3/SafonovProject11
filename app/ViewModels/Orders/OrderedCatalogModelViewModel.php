<?php

namespace App\ViewModels\Orders;

/**
 * class for transferring input
 * that was entered while adding or updating a model
 * from the user's order from interfaces (views)
 * to the application (services and repositories).
 */
class OrderedCatalogModelViewModel
{
    public int $amount;
    public int $modelId;
    public int $modelSizeId;
    public int $printingTechnologyId;
    public int $filamentTypeId;
    public int $colorId;
    public bool $isHoled;
    public bool $isParted;

    /**
     * @var string $amountInputName the name of the input.
     * It will be used to add errors to the input.
     */
    public string $amountInputName;

    /**
     * @var string $generalErrorsName the name of the container for general errors.
     * Such as "Color not exist", "Model size not exist", etc.
     */
    public string $generalErrorsName;
}
