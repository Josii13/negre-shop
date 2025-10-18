<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Peinture',
                'slug' => 'peinture',
                'description' => 'Découvrez mes créations picturales',
                'banner_title' => 'Peinture',
                'banner_description' => 'Une collection d\'œuvres contemporaines où couleurs et textures dialoguent pour créer des univers uniques. Chaque toile raconte une histoire, capture une émotion, et invite à la contemplation.',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Design',
                'slug' => 'design',
                'description' => 'Explorez mes pièces de mobilier',
                'banner_title' => 'Design Mobilier',
                'banner_description' => 'Des pièces de mobilier uniques qui allient fonctionnalité et expression artistique. Chaque création est pensée pour habiter l\'espace avec élégance et caractère, fusionnant l\'art et le design contemporain.',
                'order' => 2,
                'is_active' => true,
            ],
            // Note: La catégorie Marque est gérée par MarqueCategorySeeder
            [
                'name' => 'Gallery',
                'slug' => 'gallery',
                'description' => 'NÈGRE Workshop - Espace créatif',
                'banner_title' => 'NÈGRE Workshop Gallery',
                'banner_description' => 'Un espace inspirant dédié à la création artistique, aux événements et aux échanges culturels.',
                'order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}

