<?php

namespace App\Errors\Customer;

/**
 * a subsystem for storing errors that occurred during
 * an attempt to update a user profile.
 */
class UserProfileUpdateErrors
{
    private bool $isOldPasswordCorrect = true;

    /**
     * Adds an old password incorrect error
     */
    public function setOldPasswordCorrectness(bool $isCorrect) : void
    {
        $this->isOldPasswordCorrect = $isCorrect;
    }

    /**
     * Checks if old password was incorrect
     */
    public function isOldPasswordIncorrect() : bool
    {
        return ! $this->isOldPasswordCorrect;
    }

    /**
     * Checks if any errors occurred
     */
    public function hasAny() : bool
    {
        return ! $this->isOldPasswordCorrect;
    }
}
