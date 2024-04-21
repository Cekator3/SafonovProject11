<?php

namespace App\DTOs\Admin\Orders;

/**
 * A subsystem for reading application data about the additional service (administrator)
 */
class AdditionalServiceInfo
{
    private int $id;
    private string $name;

    public function __construct(int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * Returns the id of the additional service
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Returns the name of the additional service
     */
    public function getName() : string
    {
        return $this->name;
    }
}
