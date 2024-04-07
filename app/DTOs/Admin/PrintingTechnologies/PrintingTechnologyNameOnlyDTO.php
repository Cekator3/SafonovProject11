<?php

namespace App\DTOs\Admin\PrintingTechnologies;

/**
 * A subsystem for reading application data about printing technologies (name only)
 */
class PrintingTechnologyNameOnlyDTO
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
        assert($this->name !== '', 'accessing not initialized property: $name');
        return $this->name;
    }
}
