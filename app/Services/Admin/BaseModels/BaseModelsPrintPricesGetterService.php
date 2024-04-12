<?php

namespace App\Services\Admin\BaseModels;

use App\DTOs\Admin\BaseModels\Prices\BaseModelPrintPriceDTO;
use App\Repositories\Admin\BaseModels\BaseModelPriceRepository;

/**
 * Subsystem for getting stored information on base models printing prices.
 */
class BaseModelsPrintPricesGetterService
{
    /**
     * Returns base model's printing prices.
     */
    public function get(int $baseModelId) : BaseModelPrintPriceDTO|null
    {
        $models = new BaseModelPriceRepository();

        return $models->get($baseModelId);
    }
}
