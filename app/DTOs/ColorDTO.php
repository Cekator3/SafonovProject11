<?php

namespace App\DTOs;

/**
 * A subsystem for reading application data about colors
 */
class ColorDTO
{
    private int $id;
    private string $name = '';
    private string $code = '';

    public function __construct(int $id,
                                string $name,
                                string $code)
    {
        $this->id = $id;
        $this->name = $name;
        $this->code = $code;
    }

    /**
     * Returns the id of the color
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Returns the name of the color
     */
    public function getName() : string
    {
        assert($this->name !== '', 'accessing not initialized property: $name');
        return $this->name;
    }

    /**
     * Returns the color's rgb code
     */
    public function getRgb() : string
    {
        assert($this->code !== '', 'accessing not initialized property: $code');
        return $this->code;
    }
}
