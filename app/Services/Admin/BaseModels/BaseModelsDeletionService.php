<?php

namespace App\Services\Admin\BaseModels;

use App\Repositories\Admin\BaseModels\BaseModelRepository;
use App\Repositories\Images\BaseModelGalleryImagesRepository;
use App\Repositories\Images\BaseModelThumbnailRepository;

/**
 * Subsystem for deleting stored information on base model.
 */
class BaseModelsDeletionService
{
    private function removeThumbnail(string $filename) : void
    {
        $thumbnails = new BaseModelThumbnailRepository();
        $thumbnails->remove($filename);
    }

    /**
     * @param string[] $filenames
     */
    private function clearGallery(array $filenames) : void
    {
        $gallery = new BaseModelGalleryImagesRepository();

        foreach ($filenames as $filename)
            $gallery->remove($filename);
    }

    /**
     * Deletes the additional service.
     *
     * @param int $id The identifier of the additional service
     */
    public function remove(int $id) : void
    {
        $models = new BaseModelRepository();

        $thumbnail = $models->getThumbnail($id);
        $galleryImages = $models->getAllGalleryImages();
        $models->remove($id);

        $this->removeThumbnail($thumbnail);
        $this->clearGallery($galleryImages);
    }
}
