<?php

namespace Database\Seeders;

use App\Models\Categories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Categories::create([
            'id' => 1,
            'name' => 'Cafe phin',
            'path' => '/drip-coffee',
            'is_show_in_nav' => 1
        ]);
        Categories::create([
            'id' => 2,
            'name' => 'Cafe đặc biệt',
            'path' => '/special-coffee',
            'is_show_in_nav' => 1
        ]);
        Categories::create([
            'id' => 3,
            'name' => 'Pha sẵn',
            'path' => '/ready-to-drink-coffee',
            'is_show_in_nav' => 1
        ]);
    }
}
