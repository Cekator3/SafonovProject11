<?php

namespace App\ViewModels\Auth;

/**
 * A subsystem for transferring customer's credentials needed for resetting his password from interfaces (views) to the application (Services and Repositories).
 */
class CustomerResetPasswordCredentials
{
    private string $token;
    private string $email;
    private string $password;
    private string $passwordConfirmation;


    public function __construct(string $token, string $email, string $password, string $passwordConfirmation)
    {
        $this->token = $token;
        $this->email = $email;
        $this->password = $password;
        $this->passwordConfirmation = $passwordConfirmation;
    }


    /**
     * Returns customer's reset password token
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * Returns customer's email
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Returns customer's password
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Returns customer's password confirmation
     */
    public function getPasswordConfirmation(): string
    {
        return $this->passwordConfirmation;
    }

    /**
     * Returns customer's credentials
     * @return string[]
     */
    public function getAll() : array
    {
        return [
            'token' => $this->token,
            'email' => $this->email,
            'password' => $this->password
        ];
    }
}
