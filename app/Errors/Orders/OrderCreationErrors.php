<?php

namespace App\Errors\Orders;

/**
 * A subsystem for storing errors that occurred during
 * an attempt to create a new order for user.
 */
final class OrderCreationErrors
{
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
     * Returns true if any error occurred
     */
    public function hasAny() : bool
    {
        return $this->errors !== 0;
    }
}
