<?php

namespace App\Errors\Orders;

/**
 * A subsystem for storing errors that occurred during
 * an attempt to create a new order for user.
 */
final class OrderCreationErrors
{
    public const ERROR_USER_ALREADY_HAVE_CURRENT_ORDER = 1;
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
     * Returns true if occurred an error because base model
     * already exists (not unique)
     */
    public function isAlreadyExist() : bool
    {
        return ($this->errors & static::ERROR_BASE_MODEL_ALREADY_EXIST) !== 0;
    }

    /**
     * Returns true if any error occurred
     */
    public function hasAny() : bool
    {
        return $this->errors !== 0;
    }
}
