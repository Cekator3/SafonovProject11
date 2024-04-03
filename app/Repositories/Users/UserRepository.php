<?php

namespace App\Repositories\Users;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    protected function hashPassword(string $password) : string
    {
        return Hash::make($password);
    }

    protected function isPasswordMatches(string $password, string $password_hash) : bool
    {
        return Hash::check($password, $password_hash);
    }

    protected function isEmailInUse(string $email) : bool
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
    public function normalizeEmail(string $email) : string
    {
        return strtolower($email);
    }
}
