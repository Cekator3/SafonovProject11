<?php

namespace App\DTOs;

/**
 * A subsystem for reading application data about colors
 */
class ColorDTO
{
    protected int $id;
    protected string $code = '';

    public function __construct(int $id, string $code)
    {
        $this->id = $id;
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
     * Returns the color's rgb code
     */
    public function getRgb() : string
    {
        assert($this->code !== '', 'accessing not initialized property: $code');
        return $this->code;
    }
}
