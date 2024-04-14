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
    public int $userId;
    public int $modelId;
    public int $modelSizeId;
    public int $printingTechnologyId;
    public int $filamentTypeId;
    public int $colorId;
    public bool $isHoled;
    public bool $isParted;
}
