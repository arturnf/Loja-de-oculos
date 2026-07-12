<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $desktopImage = file_exists(public_path('img/banners/1783794035_desktop.png'))
            ? 'img/banners/1783794035_desktop.png'
            : null;

        $mobileImage = file_exists(public_path('img/banners/1783818762_mobile.png'))
            ? 'img/banners/1783818762_mobile.png'
            : null;

        $banner = Banner::first();

        $data = [
            'img_desktop' => $desktopImage,
            'img_mobile' => $mobileImage,
            'titulo' => null,
            'texto' => null,
            'texto_botao' => null,
            'link' => null,
            'ativo' => false,
        ];

        if ($banner) {
            $banner->update($data);
            return;
        }

        Banner::create($data);
    }
}
