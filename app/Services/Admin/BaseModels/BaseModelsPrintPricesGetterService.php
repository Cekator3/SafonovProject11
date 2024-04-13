<?php

namespace App\Services\Admin\BaseModels;

use App\DTOs\Admin\BaseModels\Prices\BaseModelPrintPriceDTO;
use App\Repositories\Admin\BaseModels\BaseModelPriceRepository;
use App\DTOs\Admin\BaseModels\Prices\AdditionalServiceWithPriceDTO;
use App\Repositories\Images\AdditionalServiceThumbnailRepository;

/**
 * Subsystem for getting stored information on base models printing prices.
 */
class BaseModelsPrintPricesGetterService
{
    /**
     * @var AdditionalServiceWithPriceDTO[] $additionalServices
     */
    private function setAdditionalServicesThumbnailsUrls(array $additionalServices) : void
    {
        $thumbnails = new AdditionalServiceThumbnailRepository();
        foreach ($additionalServices as $additionalService)
        {
            $url = $thumbnails->get($additionalService->getPreviewImageFilename());

            $additionalService->setPreviewImageUrl($url);
        }
    }

    /**
     * Returns base model's printing prices.
     */
    public function get(int $baseModelId) : BaseModelPrintPriceDTO|null
    {
        $models = new BaseModelPriceRepository();

        $model = $models->get($baseModelId);
        if ($model !== null)
            $this->setAdditionalServicesThumbnailsUrls($model->getAdditionalServices());

        return $model;
    }
}
