<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    private function insertUser(int $amount, UserRole $role)
    {
        for ($i = 0; $i < $amount; $i++) 
        {
            try
            {
                DB::table('users')->insert([
                    'email' => fake()->email(),
                    'role' => $role->value,
                    'password' => Hash::make('1'),
                ]);
            }
            catch (\Throwable $e) {}
        }
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        static::insertUser(1, UserRole::Admin);
        static::insertUser(1000, UserRole::Customer);
    }
}
