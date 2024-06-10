<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::insert([
            ['id_role' => 1, 'name' => 'admin'],
            ['id_role' => 2, 'name' => 'user'],
            ['id_role' => 3, 'name' => 'staff'],
        ]);
    }
}
