<?php

namespace App\DTOs\Auth;

use App\Models\User;

/**
 * A subsystem containing the data entered by the user when attempting to register
 */
class CustomerRegistrationDTO
{
    public string $email = '';
    public bool $rememberUser = false;

    public function __construct(User $user)
    {
        $this->email = $user->email;
        $this->rememberUser = $user->remember_token !== null;
    }

    /**
     * Returns all data entered by user
     * @return string[]
     */
    public function getAll() : array
    {
        return [
            'email' => $this->email,
            'remember_me' => $this->rememberUser
        ];
    }
}
