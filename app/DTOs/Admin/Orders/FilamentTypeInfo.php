<?php

namespace App\DTOs\Admin\Orders;

/**
 * A subsystem for reading application data about the filament type (administrator)
 */
class FilamentTypeInfo
{
    private int $id;
    private string $name;

    public function __construct(int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * Returns the id of the filament type
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Returns the name of the filament type
     */
    public function getName() : string
    {
        return $this->name;
    }
}
