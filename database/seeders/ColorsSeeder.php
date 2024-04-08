<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorsSeeder extends Seeder
{
    private function insertColor(string $code) : void
    {
        DB::table('colors')->insert([
            'code' => $code
        ]);
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->insertColor('FFFFFF');
        $this->insertColor('FFD600');
        $this->insertColor('0019FF');
        $this->insertColor('00FFC2');
        $this->insertColor('FF0000');
    }
}
