<?php

namespace App\Services\Admin\AdditionalServices;

use App\Repositories\Admin\AdditionalServiceRepository;
use App\Repositories\Images\AdditionalServiceThumbnailRepository;

/**
 * Subsystem for deleting stored information on additional service.
 */
class AdditionalServicesDeletionService
{
    private function removeThumbnail(string $filename) : void
    {
        $thumbnails = new AdditionalServiceThumbnailRepository();
        $thumbnails->remove($filename);
    }

    /**
     * Deletes the additional service.
     *
     * @param int $id The identifier of the additional service
     */
    public function remove(int $id) : void
    {
        $additionalServices = new AdditionalServiceRepository();

        $thumbnail = $additionalServices->getThumbnail($id);
        $additionalServices->remove($id);
        $this->removeThumbnail($thumbnail);
    }
}
