<?php

namespace App\DTOs\Admin\PrintingTechnologies;

/**
 * A subsystem for reading application data about printing technologies
 */
class PrintingTechnologyDTO
{
    private int $id;
    private string $name;
    private string $description;

    public function __construct(int $id, string $name, string $description)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
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
        assert($this->name !== '', 'accessing not initialized property: $name');
        return $this->name;
    }

    /**
     * Returns the description of the printing technology
     */
    public function getDescription() : string
    {
        assert($this->description !== '', 'accessing not initialized property: $description');
        return $this->description;
    }
}
