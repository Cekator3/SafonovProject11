<?php

namespace App\DTOs\Orders\History;

/**
 * A subsystem for reading application data about the printing technology (administrator)
 */
class PrintingTechnologyInfo
{
    private int $id;
    private string $name;

    public function __construct(int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * Returns the id of the printing technology
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Returns the name of the printing technology
     */
    public function getName() : string
    {
        return $this->name;
    }
}
