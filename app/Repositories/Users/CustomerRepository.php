<?php

namespace App\Repositories\Users;
use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Support\Str;
use App\DTOs\Auth\UserAuthDTO;
use App\Errors\UserCredentialsUniquenessErrors;
use App\ViewModels\Auth\CustomerRegistrationViewModel;
use Illuminate\Database\UniqueConstraintViolationException;

/**
 * Subsystem for interacting with stored information on customers
 */
class CustomerRepository extends UserRepository
{
    /**
     * Stores new customer
     *
     * @param CustomerRegistrationViewModel $customer New customer's data.
     * @param UserAuthDTO|null $dataForAuth
     * It will contain data required for authentication
     * on the interface side (Web, API, etc.) if no errors occur.
     * @param UserCredentialsUniquenessErrors $errors
     * An object for storing user's credentials uniqueness errors.
     */
    public function add(CustomerRegistrationViewModel $customer,
                        UserAuthDTO|null &$dataForAuth,
                        UserCredentialsUniquenessErrors $errors) : void
    {
        $email = $this->normalizeEmail($customer->email);

        // Ensure customer's credentials are not in use.
        $errors->setEmailUniqueness($this->isEmailInUse($email));
        if ($errors->hasAny())
            return;

        // Try adding a customer to the database.
        try
        {
            $user = new User();
            $user->email = $email;
            $user->password = $this->hashPassword($customer->password);
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
     * Finds the customer by his auth credentials.
     * This function meant to be used only for laravel's login functionality.
     *
     * @param UserAuthDTO|null $dataForAuth It will contain data required for
     * authentication on the interface side (Web, API, etc.) if no errors occur.
     */
    public function findByAuthCredentials(string $email,
                                          string $password,
                                          UserAuthDTO|null &$dataForAuth) : void
    {
        $normalizedEmail = $this->normalizeEmail($email);

        $user = User::where('email', $normalizedEmail)->first();
        if ($user === null)
            return;

        if (! $this->isPasswordMatches($password, $user->password))
            return;

        $dataForAuth = new UserAuthDTO($user);
    }

    private function generateRememberMeToken() : string
    {
        return Str::random(60);
    }

    /**
     * Changes customer's password.
     * This function meant to be used only for laravel's reset password functionality.
     */
    public function changePassword(User $user, string $newPassword) : void
    {
        $user->password = $this->hashPassword($newPassword);
        $user->remember_token = $this->generateRememberMeToken();
        $user->save();
    }
}
