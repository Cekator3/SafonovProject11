<?php

namespace App\Repositories\Admin;

use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Support\Facades\DB;
use App\DTOs\Admin\AdditionalServiceDTO;
use App\Errors\Admin\AdditionalService\AdditionalServiceUpdateErrors;
use App\Errors\Admin\AdditionalService\AdditionalServiceCreationErrors;
use App\ViewModels\Admin\AdditionalService\AdditionalServiceUpdateViewModel;
use App\ViewModels\Admin\AdditionalService\AdditionalServiceCreationViewModel;
use stdClass;

/**
 * Subsystem for interaction with stored information on additional services
 */
class AdditionalServiceRepository
{
    private const string TABLE_NAME = 'additional_services';

    private function convert(stdClass $entry) : AdditionalServiceDTO
    {
        $id = $entry->id;
        $name = $entry->name;
        $description = $entry->description;
        $previewImageFilename = $entry->preview_image;

        return new AdditionalServiceDTO($id, $name, $description, $previewImageFilename);
    }

    /**
     * Returns all additional services.
     * @return AdditionalServiceDTO[]
     */
    public function getAll() : array
    {
        $entries = DB::table(static::TABLE_NAME)->get();

        $additionalServices = [];
        foreach ($entries as $entry)
            $additionalServices[] = $this->convert($entry);

        return $additionalServices;
    }

    /**
     * Returns additional service.
     */
    public function get(int $id) : AdditionalServiceDTO|null
    {
        $entry = DB::table(static::TABLE_NAME)->find($id);

        if ($entry === null)
            return null;

        return $this->convert($entry);
    }

    /**
     * Returns the thumbnail's filename of additional service.
     */
    public function getThumbnail(int $id) : string
    {
        $entry = DB::table(static::TABLE_NAME)->select('preview_image')->find($id);

        return $entry->preview_image;
    }

    /**
     * Finds all the relevant additional services
     * @return AdditionalServiceDTO[]
     */
    public function find(string $name) : array
    {
        $entries = DB::table(static::TABLE_NAME)
                     ->whereFullText('name', $name)
                     ->get();

        $additionalServices = [];
        foreach ($entries as $entry)
            $additionalServices[] = $this->convert($entry);

        return $additionalServices;
    }

    /**
     * Returns true if additional service exists.
     */
    public function isExist(string $name) : bool
    {
        return DB::table(static::TABLE_NAME)
                     ->where('name', '=', $name)
                     ->exists();
    }

    /**
     * Adds additional service.
     *
     * @param AdditionalServiceCreationViewModel $additionalService
     * New additional service's data.
     * @param AdditionalServiceCreationErrors $errors
     * An object for storing operation errors.
     */
    public function add(AdditionalServiceCreationViewModel $additionalService,
                        AdditionalServiceCreationErrors $errors) : void
    {
        try
        {
            DB::table(static::TABLE_NAME)->insert([
                'name' => $additionalService->name,
                'description' => $additionalService->description,
                'preview_image' => $additionalService->thumbnailFilename
            ]);
        }
        catch (UniqueConstraintViolationException $e)
        {
            $errors->add(AdditionalServiceCreationErrors::ERROR_ADDITIONAL_SERVICE_ALREADY_EXIST);
        }
    }

    /**
     * Updates additional service.
     *
     * @param AdditionalServiceUpdateViewModel $additionalService New additional service's data.
     * @param AdditionalServiceUpdateErrors $errors
     * An object for storing operation errors.
     */
    public function update(AdditionalServiceUpdateViewModel $additionalService,
                           AdditionalServiceUpdateErrors $errors) : void
    {
        try
        {
            $newData = [
                'name' => $additionalService->name,
                'description' => $additionalService->description,
            ];
            if ($additionalService->isNeedToUpdateThumbnail())
                $newData['preview_image'] = $additionalService->thumbnailFilename;

            DB::table(static::TABLE_NAME)->where('id', '=', $additionalService->id)
                                         ->update($newData);
        }
        catch (UniqueConstraintViolationException $e)
        {
            $errors->add(AdditionalServiceUpdateErrors::ERROR_ADDITIONAL_SERVICE_ALREADY_EXIST);
        }
    }

    /**
     * Deletes additional service.
     *
     * @param int $id Identifier of the additional service
     */
    public function remove(int $id) : void
    {
        DB::table(static::TABLE_NAME)->delete($id);
    }
}
