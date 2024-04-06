<?php

namespace App\Services\Admin\AdditionalServices;
use App\DTOs\Admin\AdditionalServiceDTO;
use App\Repositories\AdditionalServiceRepository;
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
        $additionalService = $additionalServices->getAll();

        foreach ($additionalServices as $additionalService)
            $this->setThumbnailUrl($additionalService);

        return $additionalService;
    }

    /**
     * Returns additional service.
     */
    public function get(int $additionalServiceId) : AdditionalServiceDTO|null
    {
        $additionalServices = new AdditionalServiceRepository();
        $additionalService = $additionalServices->get($additionalServiceId);

        if ($additionalService === null)
            return null;

        $this->setThumbnailUrl($additionalService);

        return $additionalService;
    }

    /**
     * Finds all the relevant additional services
     * @return AdditionalServiceDTO[]
     */
    public function find(string $name) : array
    {
        $additionalServices = new AdditionalServiceRepository();
        $additionalService = $additionalServices->find($name);

        foreach ($additionalServices as $additionalService)
            $this->setThumbnailUrl($additionalService);

        return $additionalService;
    }
}
