<?php

namespace App\Errors\Customer;

/**
 * a subsystem for storing errors that occurred during
 * an attempt to update a user profile in the repository.
 */
class UserProfileUpdateErrors
{
    private bool $isOldPasswordWrong;

    public function __construct(bool $isOldPasswordWrong = false)
    {
        $this->isOldPasswordWrong = $isOldPasswordWrong;
    }

    /**
     * Checks if update failed because of incorrect old password.
     */
    public function isOldPasswordWrong() : bool
    {
        return $this->isOldPasswordWrong;
    }

    /**
     * Checks if any errors were encountered.
     */
    public function hasAny() : bool
    {
        return $this->isOldPasswordWrong;
    }
}
