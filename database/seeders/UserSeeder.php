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
        $password = Hash::make('1');
        for ($i = 0; $i < $amount; $i++)
        {
            try
            {
                DB::table('users')->insert([
                    'email' => "test{$i}{$role->value}@mail.ru",
                    'role' => $role->value,
                    'password' => $password,
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
        DB::table('users')->insert([
            'email' => 'admin@a.a',
            'role' => UserRole::Admin,
            'password' => Hash::make('1'),
        ]);
        static::insertUser(1000, UserRole::Customer);
    }
}
