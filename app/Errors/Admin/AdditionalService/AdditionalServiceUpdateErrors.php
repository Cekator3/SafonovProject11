<?php

namespace App\Errors\Admin\AdditionalService;

/**
 * A subsystem for storing errors that occurred during
 * an attempt to update a additional service.
 */
class AdditionalServiceUpdateErrors
{
    public const ERROR_ADDITIONAL_SERVICE_ALREADY_EXIST = 1;
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
     * Returns true if occurred an error because additional service
     * already exists
     */
    public function isAlreadyExist() : bool
    {
        return ($this->errors & static::ERROR_ADDITIONAL_SERVICE_ALREADY_EXIST) !== 0;
    }

    /**
     * Returns true if any error occurred
     */
    public function hasAny() : bool
    {
        return $this->errors !== 0;
    }

}
