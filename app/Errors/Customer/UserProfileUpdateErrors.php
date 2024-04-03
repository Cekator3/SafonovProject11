<?php

namespace App\Errors\Customer;

/**
 * a subsystem for storing errors that occurred during
 * an attempt to update a user profile in the repository.
 */
class UserProfileUpdateErrors
{
    public bool $isOldPasswordWrong = false;

    /**
     * Checks if any errors were encountered.
     */
    public function hasAny() : bool
    {
        return $this->isOldPasswordWrong;
    }
}
