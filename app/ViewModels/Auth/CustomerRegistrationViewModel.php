<?php

namespace App\ViewModels\Auth;

/**
 * Class for transferring customer's registration data
 * from interfaces (views)
 * to the application (Services and Repositories).
 */
class CustomerRegistrationViewModel
{
    public string $email = '';
    public string $password = '';
    public string $passwordConfirmation = '';
    public bool $rememberUser = false;
}
