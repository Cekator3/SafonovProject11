<?php

namespace App\Repositories;

use App\DTOs\Auth\UserAuthDTO;
use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\ViewModels\CustomerViewModel;
use App\Errors\UserCredentialsUniquenessErrors;
use Illuminate\Database\UniqueConstraintViolationException;

/**
 * Subsystem for interacting with users data 
 * that is stored in the repository (data storage).
 */
class UserRepository
{
    private static function hashPassword(string $password) : string
    {
        return Hash::make($password);
    }

    private static function isEmailInUse(string $email) : bool
    {
        return User::where('email', $email)->exists();
    }

    /**
     * Translates the email into the form in which it is stored in the repository.
     * 
     * TODO This code is not clean: 
     * External code shouldn't bother in what form the data is stored in the repository.
     * This function meant to be used only for laravel's reset password functionality.
     */
    public static function normalizeEmail(string $email) : string
    {
        return strtolower($email);
    }

    /**
     * Adds new customer's data to the repository (data storage).
     * 
     * @param CustomerViewModel $customer New customer's data.
     * @param UserAuthDTO|null $dataForAuth 
     * It will contain data required for authentication 
     * on the interface side (Web, API, etc.) if no errors occur.
     * @param UserCredentialsUniquenessErrors $errors 
     * An object for storing user's credentials uniqueness errors.
     */
    public static function addCustomer(CustomerViewModel $customer, 
                                       UserAuthDTO|null &$dataForAuth,
                                       UserCredentialsUniquenessErrors $errors) : void
    {
        $email = static::normalizeEmail($customer->email);

        // Ensure customer's credentials are not in use.
        $errors->setEmailUniqueness(static::isEmailInUse($email));
        if ($errors->hasAny())
            return;

        // Try adding a customer to the database.
        try
        {
            $user = new User();
            $user->email = $email;
            $user->password = static::hashPassword($customer->password);
            $user->role = UserRole::Customer;
            $user->save();

            $dataForAuth = new UserAuthDTO($user);
        }
        catch (UniqueConstraintViolationException $e)
        {
            $errors->setEmailUniqueness(true);
        }
    }

    /**
     * Finds a user by his auth credentials.
     * This function meant to be used only for laravel's login functionality.
     *
     * @param string $email The user's email.
     * @param string $password The user's password.
     * @param UserAuthDTO|null $dataForAuth It will contain data required for 
     * authentication on the interface side (Web, API, etc.) if no errors occur.
     */
    public static function findUserByAuthCredentials(string $email, 
                                                     string $password,
                                                     UserAuthDTO|null &$dataForAuth) : void
    {
        $normalizedEmail = static::normalizeEmail($email);

        $user = User::where('email', $normalizedEmail)->first();
        if ($user === null)
            return;

        if (! Hash::check($password, $user->password))
            return;

        $dataForAuth = new UserAuthDTO($user);
    }

    private static function generateRememberMeToken() : string
    {
        return Str::random(60);
    }

    /**
     * Changes user's password. 
     * This function meant to be used only for laravel's reset password functionality.
     * 
     * @param User $user Eloquent model of the user whose password is to be changed.
     * @param string $newPassword New user's password.
     */
    public static function changeUserPassword(User $user, string $newPassword) : void
    {
        $user->password = static::hashPassword($newPassword);
        $user->remember_token = static::generateRememberMeToken();
        $user->save();
    }
}
