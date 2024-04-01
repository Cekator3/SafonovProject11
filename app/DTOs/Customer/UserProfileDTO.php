<?php

namespace App\DTOs\Customer;

class UserProfileDTO
{
    private string $email;
    private string $profilePicture;

    public function __construct(string $email, string $profilePicture)
    {
        $this->email = $email;
        $this->profilePicture = $profilePicture;
    }

    public function getEmail() : string
    {
        return $this->email;
    }

    public function getProfilePicture() : string
    {
        return $this->profilePicture;
    }
}
