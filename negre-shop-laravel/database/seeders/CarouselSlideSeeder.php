<?php

namespace Database\Seeders;

use App\Models\CarouselSlide;
use Illuminate\Database\Seeder;

class CarouselSlideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $slides = [
            [
                'title' => 'Art Contemporain',
                'description' => 'Une exploration des formes et des couleurs',
                'image' => 'img1.jpg',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Design Unique',
                'description' => 'Mobilier d\'exception fait main',
                'image' => 'img2.jpg',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Créations Originales',
                'description' => 'L\'art rencontre la fonctionnalité',
                'image' => 'img1.jpg',
                'order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($slides as $slide) {
            CarouselSlide::create($slide);
        }
    }
}

