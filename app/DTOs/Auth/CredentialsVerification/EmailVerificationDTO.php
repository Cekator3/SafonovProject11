<?php

namespace App\DTOs\Auth\CredentialsVerification;

/**
 * A subsystem containing data on the user's e-mail confirmation status
 */
class EmailVerificationDTO
{
    private string $email;
    private bool $isResent;

    public function __construct(string $email, bool $isResent)
    {
        $this->email = $email;
        $this->isResent = $isResent;
    }

    public function getEmail() : string
    {
        return $this->email;
    }

    public function isResent() : bool
    {
        return $this->isResent;
    }
}
