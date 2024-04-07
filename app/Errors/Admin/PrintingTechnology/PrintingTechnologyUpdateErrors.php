<?php

namespace App\Errors\Admin\PrintingTechnology;

/**
 * A subsystem for storing errors that occurred during
 * an attempt to update a printing technology.
 */
final class PrintingTechnologyUpdateErrors
{
    public const ERROR_PRINTING_TECHNOLOGY_ALREADY_EXIST = 1;
    private int $errors = 0;

    /**
     * Adds error
     *
     * @param int $error Error code
     */
    public function add(int $error) : void
    {
        $this->errors |= $error;
    }

    /**
     * Returns true if occurred an error because printing technology
     * already exists (not unique)
     */
    public function isAlreadyExist() : bool
    {
        return ($this->errors & static::ERROR_PRINTING_TECHNOLOGY_ALREADY_EXIST) !== 0;
    }

    /**
     * Returns true if any error occurred
     */
    public function hasAny() : bool
    {
        return $this->errors !== 0;
    }
}
