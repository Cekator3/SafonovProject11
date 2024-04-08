<?php

namespace App\Repositories;

use stdClass;
use App\DTOs\ColorDTO;
use Illuminate\Support\Facades\DB;

/**
 * Subsystem for interaction with stored information on colors
 */
class ColorsRepository
{
    private function convert(stdClass $entry) : ColorDTO
    {
        $id = $entry->id;
        $name = $entry->name;
        $code = $entry->code;

        return new ColorDTO($id, $name, $code);
    }

    /**
     * Returns all colors.
     * @return ColorDTO[]
     */
    public function getAll() : array
    {
        $entries = DB::table('colors')->get();

        $colors = [];
        foreach ($entries as $entry)
            $colors[] = $this->convert($entry);

        return $colors;
    }

    /**
     * Returns color.
     */
    public function get(int $id) : ColorDTO|null
    {
        $entry = DB::table('colors')->find($id);

        if ($entry === null)
            return null;

        return $this->convert($entry);
    }
}
