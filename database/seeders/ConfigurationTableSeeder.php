<?php

namespace Database\Seeders;

use App\Models\Configuration;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConfigurationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // seeder settings default - don't change
        $configurations = [
            [
                'key' => 'site_name',
                'value' => 'Coffee Shop'
            ],
            [
                'key' => 'site_description',
                'value' => 'Web quản lý, mua bán cafe'
            ],
            [
                'key' =>'site_slogan',
                'value' => 'Nơi đem lại cho bạn những trải nghiệm tốt nhất!'
            ],
            [
                'key' =>'site_slogan_description',
                'value' => 'Với mong muốn mang hương vị cafe đi khắp mọi nơi, shop mang đến cho bạn những dịch vụ và sản phẩm tốt nhất.'
            ],
            [
                'key' => 'logo',
                'value' => 'frontend/img/logo.jpg'
            ],
            [
                'key' => 'address_shop',
                'value' => 'Hà Nội'
            ],
            [
                'key' => 'phone_shop',
                'value' => '0123456789'
            ],
            [
                'key' => 'email_shop',
                'value' => 'mail@gmail.com'
            ],
            [
                'key' => 'facebook_link',
                'value' => 'https://facebook.com'
            ],
            [
                'key' => 'instagram_link',
                'value' => 'https://instagram.com'
            ],
            [
                'key' => 'tiktok_link',
                'value' => 'https://tiktok.com'
            ],
            [
                'key' => 'services_firt',
                'value' => 'Giao hàng tận nơi nhanh chóng'
            ],
            [
                'key' =>'color_services_firt',
                'value' => '#5BAB7B'
            ],
            [
                'key' => 'icon_services_firt',
                'value' => 'fas fa-truck'
            ],
            [
                'key' => 'services_second',
                'value' => 'Tư vấn tận tình'
            ],
            [
                'key' =>'color_services_second',
                'value' => '#5C9CCA'
            ],
            [
                'key' => 'icon_services_second',
                'value' => 'fas fa-headset'
            ],
            [
                'key' => 'services_third',
                'value' => 'Mang hương vị cafe đi muôn nơi'
            ],
            [
                'key' =>'color_services_third',
                'value' => '#C67B36'
            ],
            [
                'key' => 'icon_services_third',
                'value' => 'fas fa-coffee'
            ],
            [
                'key' => 'services_fourth',
                'value' => 'Sản phẩm phân phối độc quyền'
            ],
            [
                'key' =>'color_services_fourth',
                'value' => '#AB5D58'
            ],
            [
                'key' => 'icon_services_fourth',
                'value' => 'fas fa-gift'
            ],
            [
                'key' =>'text_color',
                'value' => '#ffffff'
            ]
        ];

        Configuration::insert($configurations);
    }
}
