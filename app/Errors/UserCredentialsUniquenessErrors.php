<?php

namespace App\Errors;

/**
 * A subsystem that stores errors
 * that occur when attempting to store 
 * non-unique user's credentials 
 * that should have been unique.
 */
class UserCredentialsUniquenessErrors
{
    private bool $isEmailInUse;

    public function __construct($isEmailInUse = false)
    {
        $this->isEmailInUse = $isEmailInUse;
    }

    /**
     * Sets whether the email is already in use.
     */
    public function setEmailUniqueness(bool $isEmailInUse) : void
    {
        $this->isEmailInUse = $isEmailInUse;
    }

    /**
     * Returns true if email is already in use.
     */
    public function isEmailInUse() : bool
    {
        return $this->isEmailInUse;
    }

    /**
     * Returns true if any of the credentials are already in use.
     */
    public function hasAny() : bool
    {
        return $this->isEmailInUse;
    }
}
