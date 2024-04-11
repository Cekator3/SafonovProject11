<?php

namespace App\Repositories\Admin\BaseModels;

use App\DTOs\Admin\BaseModels\Prices\BaseModelPrintPriceDTO;
use App\ViewModels\Admin\BaseModel\BaseModelPricesUpdateViewModel;

/**
 * Subsystem for interaction with stored information on base models printing prices
 */
class BaseModelPriceRepository
{
    /**
     * Returns base model's printing price.
     *
     * @param int $id Identifier of the base model
     */
    public function get(int $id) : BaseModelPrintPriceDTO|null
    {
        // ...
    }

    /**
     * Checks if base model have printing price
     *
     * @param int $id Identifier of the base model
     */
    public function isExist(int $id) : bool
    {
        // ...
    }

    /**
     * Updates printing price of base model.
     *
     * @param BaseModelPricesUpdateViewModel $model New base model's printing price data.
     */
    public function update(BaseModelPricesUpdateViewModel $model) : void
    {
        // ...
    }
}
