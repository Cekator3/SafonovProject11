<?php

namespace App\Repositories;

use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Support\Facades\DB;
use App\DTOs\Admin\AdditionalServiceDTO;
use App\Errors\Admin\AdditionalService\AdditionalServiceUpdateErrors;
use App\Errors\Admin\AdditionalService\AdditionalServiceCreationErrors;
use App\ViewModels\Admin\AdditionalService\AdditionalServiceUpdateViewModel;
use App\ViewModels\Admin\AdditionalService\AdditionalServiceCreationViewModel;

/**
 * Subsystem for interaction with stored information on additional services
 */
class AdditionalServiceRepository
{
    private const TABLE_NAME = 'additional_services';

    private function convert(array $entry) : AdditionalServiceDTO
    {
        $id = $entry['id'];
        $name = $entry['name'];
        $description = $entry['description'];
        $previewImageFilename = $entry['preview_image'];

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

        if ($entry === [])
            return null;

        return $this->convert($entry);
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
        $entries = DB::table(static::TABLE_NAME)
                     ->whereFullText('name', $name)
                     ->first();

        return $entries !== [];
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
            DB::table(static::TABLE_NAME)->where('id', '=', $additionalService->id)
                                         ->update(
            [
                'name' => $additionalService->name,
                'description' => $additionalService->description,
                'preview_image' => $additionalService->thumbnailFilename
            ]);
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
     * @param bool &$isSuccess Will be set to true if operation was successful
     */
    public function remove(int $id, bool &$isSuccess) : void
    {
        $entryId = DB::table(static::TABLE_NAME)->delete($id);

        dump($entryId);

        $isSuccess = $entryId !== 0;
    }
}
