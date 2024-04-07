<?php

namespace App\Services\Admin\AdditionalServices;
use App\DTOs\Admin\AdditionalServiceDTO;
use App\Repositories\Admin\AdditionalServiceRepository;
use App\Repositories\Images\AdditionalServiceThumbnailRepository;

/**
 * Subsystem for getting stored information on additional service.
 */
class AdditionalServicesGetterService
{
    private function setThumbnailUrl(AdditionalServiceDTO $additionalService) : void
    {
        $thumbnails = new AdditionalServiceThumbnailRepository();

        $url = $thumbnails->get($additionalService->getPreviewImageFilename());

        $additionalService->setPreviewImageUrl($url);
    }

    /**
     * Returns all additional services.
     * @return AdditionalServiceDTO[]
     */
    public function getAll() : array
    {
        $additionalServices = new AdditionalServiceRepository();
        $result = $additionalServices->getAll();

        foreach ($result as $additionalService)
            $this->setThumbnailUrl($additionalService);

        return $result;
    }

    /**
     * Returns additional service.
     */
    public function get(int $additionalServiceId) : AdditionalServiceDTO|null
    {
        $additionalServices = new AdditionalServiceRepository();
        $result = $additionalServices->get($additionalServiceId);

        if ($result !== null)
            $this->setThumbnailUrl($result);

        return $result;
    }

    /**
     * Finds all the relevant additional services
     * @return AdditionalServiceDTO[]
     */
    public function find(string $name) : array
    {
        $additionalServices = new AdditionalServiceRepository();
        $result = $additionalServices->find($name);

        foreach ($result as $additionalService)
            $this->setThumbnailUrl($additionalService);

        return $result;
    }
}
