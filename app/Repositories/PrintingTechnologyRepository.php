<?php

namespace App\Repositories;

use stdClass;
use Illuminate\Support\Facades\DB;
use App\DTOs\Admin\PrintingTechnologies\PrintingTechnologyDTO;
use Illuminate\Database\UniqueConstraintViolationException;
use App\Errors\Admin\PrintingTechnology\PrintingTechnologyUpdateErrors;
use App\Errors\Admin\PrintingTechnology\PrintingTechnologyCreationErrors;
use App\ViewModels\Admin\PrintingTechnology\PrintingTechnologyUpdateViewModel;
use App\ViewModels\Admin\PrintingTechnology\PrintingTechnologyCreationViewModel;

/**
 * Subsystem for interaction with stored information on printing technologies
 */
class PrintingTechnologyRepository
{
    private const TABLE_NAME = 'printing_technologies';

    private function convert(stdClass $entry) : PrintingTechnologyDTO
    {
        $id = $entry->id;
        $name = $entry->name;
        $description = $entry->description;

        return new PrintingTechnologyDTO($id, $name, $description);
    }

    /**
     * Returns all printing technologies.
     * @return PrintingTechnologyDTO[]
     */
    public function getAll() : array
    {
        $entries = DB::table(static::TABLE_NAME)->get();

        $printingTechnologies = [];
        foreach ($entries as $entry)
            $printingTechnologies[] = $this->convert($entry);

        return $printingTechnologies;
    }

    /**
     * Returns printing technology.
     */
    public function get(int $id) : PrintingTechnologyDTO|null
    {
        $entry = DB::table(static::TABLE_NAME)->find($id);

        if ($entry === [])
            return null;

        return $this->convert($entry);
    }

    /**
     * Finds all the relevant printing technologies.
     * @return PrintingTechnologyDTO[]
     */
    public function find(string $name) : array
    {
        $entries = DB::table(static::TABLE_NAME)
                     ->whereFullText('name', $name)
                     ->get();

        $printingTechnologies = [];
        foreach ($entries as $entry)
            $printingTechnologies[] = $this->convert($entry);

        return $printingTechnologies;
    }

    /**
     * Returns true if printing technology exists.
     */
    public function isExist(string $name) : bool
    {
        return DB::table(static::TABLE_NAME)
                     ->where('name', '=', $name)
                     ->exists();
    }

    /**
     * Adds printing technology.
     *
     * @param PrintingTechnologyCreationViewModel $printingTechnology
     * New printing technology's data.
     * @param PrintingTechnologyCreationErrors $errors
     * An object for storing operation errors.
     */
    public function add(PrintingTechnologyCreationViewModel $printingTechnology,
                        PrintingTechnologyCreationErrors $errors) : void
    {
        try
        {
            DB::table(static::TABLE_NAME)->insert([
                'name' => $printingTechnology->name,
                'description' => $printingTechnology->description,
            ]);
        }
        catch (UniqueConstraintViolationException $e)
        {
            $errors->add(PrintingTechnologyCreationErrors::ERROR_PRINTING_TECHNOLOGY_ALREADY_EXIST);
        }
    }

    /**
     * Updates printing technology.
     *
     * @param PrintingTechnologyUpdateViewModel $printingTechnology New printing technology's data.
     * @param PrintingTechnologyUpdateErrors $errors
     * An object for storing operation errors.
     */
    public function update(PrintingTechnologyUpdateViewModel $printingTechnology,
                           PrintingTechnologyUpdateErrors $errors) : void
    {
        try
        {
            $newData = [
                'name' => $printingTechnology->name,
                'description' => $printingTechnology->description,
            ];

            DB::table(static::TABLE_NAME)->where('id', '=', $printingTechnology->id)
                                         ->update($newData);
        }
        catch (UniqueConstraintViolationException $e)
        {
            $errors->add(PrintingTechnologyUpdateErrors::ERROR_PRINTING_TECHNOLOGY_ALREADY_EXIST);
        }
    }

    /**
     * Deletes printing technology.
     *
     * @param int $id Identifier of the printing technology
     */
    public function remove(int $id) : void
    {
        DB::table(static::TABLE_NAME)->delete($id);
    }
}
