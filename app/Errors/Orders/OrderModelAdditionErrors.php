<?php

namespace App\Errors\Orders;

/**
 * A subsystem for storing errors that occurred during
 * an attempt to add a new model to the user's current order.
 */
final class OrderModelAdditionErrors
{
    public const ERROR_MODEL_ALREADY_IN_ORDER = 1;

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
