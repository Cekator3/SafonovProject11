<?php

namespace App\DTOs\Admin;

/**
 * A subsystem for reading application data about printing technologies
 */
class AdditionalServiceDTO
{
    private int $id = -1;
    private string $name = '';
    private string $description = '';

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
        assert($this->id !== -1, 'accessing not initialized property: $id');
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
