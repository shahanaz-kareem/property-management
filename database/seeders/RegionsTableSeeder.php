<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class RegionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('regions')->insert([
                ['title' => 'North America'],
                ['title' => 'South America'],
                ['title' => 'Europe'],
                ['title' => 'Asia'],
                ['title' => 'Africa'],
                ['title' => 'Oceania'],
            ]);
    }
}
