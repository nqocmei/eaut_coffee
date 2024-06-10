<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'fullname' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('1234'),
            'id_role' => 1,
        ]);
        User::create([
            'fullname' => 'ngọc mai',
            'email' => 'nqocmai201@gmail.com',
            'password' => bcrypt('1234'),
            'id_role' => 1,
        ]);
        User::create([
            'fullname' => 'user',
            'email' => 'user@gmail.com',
            'password' => bcrypt('1234'),
            'id_role' => 2,
        ]);
    }
}
