<?php

namespace App\ViewModels;

/**
 * Class for transferring customer's data 
 * from interfaces (views) 
 * to the application (Services and Repositories).
 */
class CustomerViewModel
{
    public string $email = '';
    public string $password = '';
    public string $passwordConfirmation = '';
    public bool $rememberUser = false;
}
