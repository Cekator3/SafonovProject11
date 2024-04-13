<?php

namespace App\Repositories\Catalog;

use stdClass;
use Illuminate\Support\Facades\DB;
use App\DTOs\Catalog\CatalogItemDTO;
use App\DTOs\Catalog\CatalogItemListDTO;

/**
 * Subsystem for interaction with stored information on catalog items.
 */
class CatalogItemsRepository
{
    private function convertToListItem(stdClass $entry) : CatalogItemListDTO
    {
        $id = $entry->id;
        $name = $entry->name;
        $description = $entry->description;
        $previewImage = $entry->preview_image;
        return new CatalogItemListDTO($id, $name, $description, $previewImage);
    }

    /**
     * Returns all catalog items
     *
     * @return CatalogItemListDTO[]
     */
    public function getAll() : array
    {
        $entries = DB::table('models')->select(['id', 'name', 'description', 'preview_image'])->get();

        $models = [];
        foreach ($entries as $entry)
            $models []= $this->convertToListItem($entry);

        return $models;
    }

    /**
     * Finds all the relevant catalog items
     *
     * @return CatalogItemListDTO[]
     */
    public function find(string $name) : array
    {
        $entries = DB::table('models')
                     ->whereFullText('name', $name)
                     ->select(['id', 'name', 'description', 'preview_image'])
                     ->get();

        $models = [];
        foreach ($entries as $entry)
            $models[] = $this->convertToListItem($entry);

        return $models;
    }

    /**
     * Returns catalog item.
     */
    public function get(int $baseModelId) : CatalogItemDTO|null
    {
        $entry = DB::table('models')
                   ->where('id', '=', $baseModelId)
                   ->first(['name', 'description', 'preview_image']);

        if ($entry === null)
            return null;

        return new CatalogItemDTO($baseModelId, $entry->name, $entry->description, $entry->preview_image);
    }
}
