<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdditionalServiceSeeder extends Seeder
{
    private function insertAdditionalService(int $amount)
    {
        for ($i = 0; $i < $amount; $i++)
        {
            try
            {
                DB::table('additional_services')->insert([
                    'name' => fake()->name(),
                    'description' => fake()->text(),
                    'preview_image' => 'test.gif'
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
        $this->insertAdditionalService(1000);
        //
    }
}
