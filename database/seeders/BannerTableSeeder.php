<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BannerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Banner::create([
            'id' => 1,
            'title' => 'Banner header - coffee',
            'image_path' => 'images/1716224919.jpg',
            'position' => '0'
        ]);

        Banner::create([
            'id' => 2,
            'title' => 'Banner header - coffee',
            'image_path' => 'images/1716225007.jpg',
            'position' => '0'
        ]);

        Banner::create([
            'id' => 3,
            'title' => 'Banner header - coffee',
            'image_path' => 'images/1716225016.jpg',
            'position' => '0'
        ]);

        Banner::create([
            'id' => 4,
            'title' => 'Banner header - coffee',
            'image_path' => 'images/1716225026.jpg',
            'position' => '0'
        ]);

        Banner::create([
            'id' => 5,
            'title' => 'Banner coffee',
            'image_path' => 'images/1716225016.jpg',
            'position' => '1'
        ]);
    }
}
